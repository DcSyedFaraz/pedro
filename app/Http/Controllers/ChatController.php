<?php

namespace App\Http\Controllers;

use App\Events\ChatInitiated;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\User;
use App\Notifications\NewChatNotification;
use Auth;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Log;
use Notification;

class ChatController extends Controller
{
    public function showChats()
    {
        $chats = Chat::with(['userOne', 'userTwo'])->get(); // Fetch all chats with the associated users
        $users = User::role('User')->get(); // Fetch all users for searching
        return view('chats.index', compact('chats', 'users'));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')->get();
        $chats = Chat::with(['userOne', 'userTwo'])->get(); // Fetch all chats with the associated users

        // Optional: Return the search results with the same chat view or a dedicated view for search
        return view('chats.index', compact('users', 'chats'));
    }

    public function index()
    {
        $user = Auth::user();

        // Get all chats where the user is either user_one or user_two
        $chats = Chat::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)
            ->with([
                'userOne',
                'userTwo',
                'product',
                'messages' => function ($query) {
                    $query->latest()->limit(1); // Get latest message for preview
                }
            ])
            ->get()
            ->map(function ($chat) use ($user) {
                $otherUser = $chat->user_one_id === $user->id ? $chat->userTwo : $chat->userOne;
                $unreadCount = $chat->messages()
                    ->where('sender_id', '!=', $user->id)
                    ->whereNull('read_at')
                    ->count();
                return [
                    'id' => $chat->id,
                    'with_user' => [
                        'id' => $otherUser->id,
                        'name' => $otherUser->name,
                        // Add other user fields as needed
                    ],
                    'product' => [
                        'id' => $chat->product->id,
                        'name' => $chat->product->name,
                        'description' => $chat->product->description,
                        'image' => $chat->product->images->first(),
                        // Add other product fields as needed
                    ],
                    'last_message' => $chat->messages->first() ? [
                        'message' => $chat->messages->first()->message,
                        'created_at' => $chat->messages->first()->created_at,
                    ] : null,
                    'unread_count' => $unreadCount,
                ];
            });
        // dd($chats);

        return Inertia::render('Chats/Show', [
            'chat' => null, // No specific chat selected
            'chats' => $chats,
            'auth' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ],
            ],
        ]);
    }

    // public function expressInterest(Chat $chat)
    // {
    //     $user = Auth::user();

    //     // Prevent duplicate interests
    //     if ($chat->interestedUsers()->where('user_id', $user->id)->exists()) {
    //         return response()->json(['message' => 'You have already expressed interest.', 'bothInterested' => true], 400);
    //     }
    //     try {
    //         DB::beginTransaction();
    //         // Attach the user to the chat's interested users
    //         $chat->interestedUsers()->attach($user->id);

    //         // Check if both users have expressed interest
    //         $interestedCount = $chat->interestedUsers()->count();
    //         $bothInterested = $interestedCount >= 2;

    //         // Broadcast the interest event
    //         broadcast(new InterestExpressed($chat, $user))->toOthers();

    //         $otherUser = $chat->userOne->id === $user->id ? $chat->userTwo : $chat->userOne;
    //         // dd($otherUser);
    //         // Send notification to the other user
    //         if ($otherUser) {
    //             $message = "{$user->name} has expressed interest in your chat.";
    //             $url = route('chats.show', ['id' => $chat->id]);

    //             $otherUser->notify(new DynamicNotification($message, $url));
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'message' => 'Interest expressed successfully.',
    //             'bothInterested' => $bothInterested,
    //         ], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'message' => $e->getMessage(),
    //         ], 400);
    //     }
    // }

    /**
     * Display the specified chat with messages.
     */
    public function show($id)
    {
        $chat = Chat::findOrFail($id);
        $user = Auth::user();

        // Ensure the authenticated user is part of the chat
        if ($chat->user_one_id !== $user->id && $chat->user_two_id !== $user->id) {
            abort(403);
        }

        $messages = $chat->messages()->with('sender')->orderBy('created_at')->get();

        // Mark all unread messages as read
        $chat->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $otherUser = $chat->user_one_id === $user->id ? $chat->userTwo : $chat->userOne;

        // Get all chats for the sidebar
        $chats = Chat::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)
            ->with([
                'userOne',
                'userTwo',
                'messages'

            ])
            ->get()
            ->map(function ($chat) use ($user) {
                $otherUser = $chat->user_one_id === $user->id ? $chat->userTwo : $chat->userOne;
                $unreadCount = $chat->messages()
                    ->where('sender_id', '!=', $user->id)
                    ->whereNull('read_at')
                    ->count();
                // dd($chat);

                return [
                    'id' => $chat->id,
                    'with_user' => [
                        'id' => $otherUser->id,
                        'name' => $otherUser->name,
                    ],
                    'last_message' => $chat->messages->last() ? [
                        'message' => $chat->messages->last()->message,
                        'created_at' => $chat->messages->last()->created_at,
                    ] : null,
                    'unread_count' => $unreadCount,
                ];
            });
        // dd($chats);

        return Inertia::render('Chats/Show', [
            'chat' => [
                'id' => $chat->id,
                'participants' => [
                    'user_one' => $chat->userOne,
                    'user_two' => $chat->userTwo,
                ],
                'messages' => $messages->map(function ($message) {
                    return [
                        'id' => $message->id,
                        'sender' => [
                            'id' => $message->sender->id,
                            'name' => $message->sender->name,
                        ],
                        'message' => $message->message,
                        'created_at' => $message->created_at->toDateTimeString(),
                    ];
                }),
            ],
            'chats' => $chats,
            'otherUser' => $otherUser,
            'auth' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ],
            ],
        ]);
    }

    /**
     * Store a new message in the specified chat.
     */
    public function storeMessage(Request $request, Chat $chat)
    {
        $user = Auth::user();
        Log::info('storeMessage called', ['chat_id' => $chat->id, 'user_id' => Auth::id()]);

        // Ensure the authenticated user is part of the chat
        if ($chat->user_one_id !== $user->id && $chat->user_two_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $message = $chat->messages()->create([
            'sender_id' => $user->id,
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json([
            'message' => [
                'id' => $message->id,
                'sender' => [
                    'id' => $user->id,
                    'name' => $user->name,
                ],
                'message' => $message->message,
                'created_at' => $message->created_at->toDateTimeString(),
            ],
        ]);
    }

    /**
     * Initiate a chat from a product page.
     */
    public function initiateChat(Request $request, $userTwo)
    {
        $user = Auth::user();
        $Usertwomodel = User::findOrFail($userTwo);

        // Prevent users from chatting with themselves
        if ($userTwo === $user->id) {
            return back()->with('error', 'You cannot chat with yourself.');
        }

        // Check if a chat already exists between the two users for this specific product
        $chat = Chat::where(function ($query) use ($user, $userTwo) {
            $query->where('user_one_id', $user->id)
                ->where('user_two_id', $userTwo);
        })->orWhere(function ($query) use ($user, $userTwo) {
            $query->where('user_one_id', $userTwo)
                ->where('user_two_id', $user->id);
        })->first();

        if (!$chat) {
            // Create a new chat
            $chat = Chat::create([
                'user_one_id' => $user->id,
                'user_two_id' => $userTwo,
            ]);

            // Broadcast the ChatInitiated event
            broadcast(new ChatInitiated($chat))->toOthers();

            $Usertwomodel->notify(new NewChatNotification($chat, $Usertwomodel));


        }

        // Redirect to the chat page
        return redirect()->route('chats.show', $chat->id);
    }
}
