<template>
    <div class="card-1">
        <div class="border-right side" ref="sidebar">
            <ChatSidebar :chats="localChats" :current-chat-id="chat?.id" />
        </div>
        <div class="chat-side" ref="chatSide">
            <template v-if="chat">
                <!-- Display the selected chat -->
                <ChatWindow :chat="chat" :current-user="authUser" :otherUser="otherUser" @message-sent="handleMessageSent"
                    @message-received="handleMessageReceived" @chat-viewed="handleChatViewed" />
            </template>
            <template v-else>
                <!-- Display default content when no chat is selected -->
                <div class="default-message text-center">
                    <div class="icon-container">
                        <i class="fas fa-comments chat-icon"></i>
                    </div>
                    <h2>Welcome to Your Chats</h2>
                    <p>Select a chat from the sidebar to start messaging.</p>
                    <!-- <button class="btn btn-primary start-chat-btn">Start a New Chat</button> -->
                </div>

            </template>

        </div>
    </div>
</template>

<script>
import ChatSidebar from '@/Components/ChatSidebar.vue';
import ChatWindow from '@/Components/ChatWindow.vue';

export default {
    components: {
        ChatSidebar,
        ChatWindow,
    },
    props: {
        chat: {
            type: Object,
        },
        otherUser: {
            type: Object,
        },
        chats: {
            type: Array,
            required: true,
        },
        auth: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            localChats: JSON.parse(JSON.stringify(this.chats)),
            chatChannels: [],
        };
    },
    watch: {
        chats: {
            handler(newChats) {
                this.localChats = JSON.parse(JSON.stringify(newChats));
                this.setupEchoListeners(); // Re-setup listeners if chats change
            },
            deep: true,
        },
    },
    computed: {
        authUser() {
            return this.auth.user;
        },
    },
    methods: {
        handleMessageSent(message) {
            console.log(message, this.chat.id, 'ss');
            this.updateLastMessage(this.chat.id, message);
        },
        handleMessageReceived(message) {
            this.updateLastMessage(this.chat.id, message);
        },
        handleChatViewed(chatId) {
            if (chatId === this.chat.id) {
                const chatIndex = this.localChats.findIndex(c => c.id === chatId);
                if (chatIndex !== -1) {
                    this.localChats[chatIndex] = {
                        ...this.localChats[chatIndex],
                        unread_count: 0,
                    };
                }
            }
        },
        updateLastMessage(chatId, message) {
            console.log(message, chatId);

            if (!message) {
                console.error('Invalid message object:', message);
                return;
            }
            const chatIndex = this.localChats.findIndex(c => c.id === chatId);
            if (chatIndex !== -1) {
                const isCurrentChat = chatId === this.chat.id;
                const unreadCount = isCurrentChat ? 0 : this.localChats[chatIndex].unread_count + 1;
                this.localChats[chatIndex] = {
                    ...this.localChats[chatIndex],
                    last_message: {
                        message: message,
                        // created_at: message.created_at,
                    },
                    unread_count: unreadCount,
                };
            }
        },

        setupEchoListeners() {
            // Leave existing channels to prevent duplicate listeners
            if (this.chatChannels.length > 0) {
                this.chatChannels.forEach(channel => {
                    window.Echo.leaveChannel(channel.name);
                });
            }

            // Set up new chat channels
            this.chatChannels = this.localChats.map(chat => {
                const channel = window.Echo.private(`chat.${chat.id}`);
                channel.listen('.MessageSent', (e) => {
                    console.log('MessageSent event received:', e);
                    // Update last message in localChats
                    this.updateLastMessage(chat.id, e.message);
                });
                return channel;
            });


        },
        setupUserChannel() {
            const userId = this.authUser.id;
            window.Echo.private(`user.${userId}`)
                .listen('.ChatInitiated', (e) => {
                    console.log('ChatInitiated event received:', e);
                    // Handle the new chat initiation, e.g., update localChats
                    this.localChats.push(e.chat);
                    this.setupEchoListeners();
                });
        },
        toggleSidebar() {
            const chatSide = this.$refs.chatSide;
            const sidebar = this.$refs.sidebar;

            chatSide.classList.toggle('active');
            sidebar.classList.toggle('active');
        }
    },
    mounted() {
        this.setupEchoListeners();
        this.setupUserChannel();

        // Add event listener for close button
        const closeButton = document.getElementById('close-bar');
        closeButton.addEventListener('click', this.toggleSidebar);
    },
    beforeUnmount() {
        if (this.chatChannels.length > 0) {
            this.chatChannels.forEach(channel => {
                window.Echo.leaveChannel(channel.name);
            });
        }
        // Leave user channel
        window.Echo.leave(`user.${this.authUser.id}`);

        // Clean up event listener
        const closeButton = document.getElementById('close-bar');
        closeButton.removeEventListener('click', this.toggleSidebar);
    },
};
</script>

<style scoped>
.default-message {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: #f7f9fc;
    padding: 20px;
    border-radius: 10px;
}

.icon-container {
    background-color: #007bff;
    border-radius: 50%;
    padding: 20px;
    margin-bottom: 20px;
}

.chat-icon {
    font-size: 3rem;
    color: white;
}

h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #343a40;
    margin-bottom: 10px;
}

p {
    font-size: 1.2rem;
    color: #6c757d;
    margin-bottom: 30px;
}

.start-chat-btn {
    padding: 10px 20px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
}
</style>
