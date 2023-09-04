<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    //index
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('admin.users.index',compact('data'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    //Customer
    public function customer(Request $request)
    {
        $customers = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })
        ->orderBy('id', 'DESC')
        ->paginate(5);
        
        return view('admin.customer.index',compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    //Customer Create
    public function customer_create(Request $request)
    {
        $roles = Role::select(['id', 'name'])->where('name', 'user')->get();
       return view('admin.customer.create',compact('roles'));
    }

    //Customer Store
    public function customer_store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        $customers = User::create($input);
        $customers->assignRole($request->input('roles'));
    
        return redirect()->route('customer.index')
                        ->with('success','Customer created successfully');
    }

    //Customer Edit
    public function customer_edit($id)
    {
        $user = User::find($id);
        $roles = Role::select(['id', 'name'])->where('name','user')->get();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('admin.customer.edit',compact('user','roles','userRole'));
    }

    //Customer Update
    public function customer_update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$id,
            'password'  => 'same:confirm-password',
            'roles'     => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('customer.index')
            ->with('success','Customer updated successfully');
    }

    //Customer Destroy
    public function customer_destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('customer.index')
                        ->with('success','Customer deleted successfully');
    }

    //User Create
    public function create()
    {
        $roles = Role::select(['id','name'])->get();
        return view('admin.users.create',compact('roles'));
    }

    //User Store
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    //User Show
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }

    //User Edit
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id','name')->get();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.users.edit',compact('user','roles','userRole'));
    }

    //User Update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    //User Destroy
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

}
