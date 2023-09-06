<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\StoredService;
use App\Rules\PersonalEmail;
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
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    //Customer
    public function customer(Request $request)
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })
            ->orderBy('id', 'DESC')
            ->paginate(5);
        $customers = Customer::all();

        return view('admin.customer.index', compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    //Customer Create
    public function customer_create(Request $request)
    {
        $roles = Role::select(['id', 'name'])->where('name', 'user')->get();
        return view('admin.customer.create', compact('roles'));
    }

    //Customer Store
    public function customer_store(Request $request)
    {


        $this->validate($request, [
            'customer_name' => 'required',
            'service_agreement' => 'required',
            'active' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'phone_type' => 'required',
            'number' => 'required',
            'contact' => 'required',
            'estimate_template' => 'required',
            'job_template' => 'required',
            'invoice_template' => 'required',
            'referral' => 'required',
            'assigned_contract' => 'required',
            'taxable' => 'required',
            'tax_item' => 'required',
            'bussiness_id' => 'required',
        ]);


        $input = $request->all();
        $user = new User();
        $user->name = $input['customer_name'];
        $user->email = $input['per_email'];
        $user->password = bcrypt('12345678');
        // $user->save();

        $user->assignRole($request->input('roles'));
        // dd($user);



        $customers = Customer::create([

            'user_id' => $user->id,
            'customer_name' => $request['customer_name'],
            'service_agreement' => $request['service_agreement'],
            'acnum' => $request['acnum'],
            'activeCustomer' => $request['activeCustomer'],
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'phone_type' => $request['phone_type'],
            'number' => $request['number'],
            'ext' => $request['ext'],
            'department' => $request['department'],
            'job_title' => $request['job_title'],
            'email_type' => $request['email_type'],
            'email' => $request['email'],
            'contact' => $request['contact'],

            'estimate_template' => $request['estimate_template'],
            'job_template' => $request['job_template'],
            'invoice_template' => $request['invoice_template'],
            'notes' => $request['notes'],
            'referral' => $request['referral'],
            'amount' => $request['amount'],
            'assigned_contract' => $request['assigned_contract'],
            'taxable' => $request['taxable'],
            'tax_item' => $request['tax_item'],
            'bussiness_id' => $request['bussiness_id'],
            'assigned_rep' => $request['assigned_rep'],
            'commission_sign' => $request['commission_sign'],
            'commission' => $request['commission'],
        ]);
        foreach ($request['nick_name'] as $key => $value) {
            StoredService::create([
                'customer_id' => $customers->id,
                'nick_name' => $value,
                'primary' => $request['primary'][$key],
                'billing_address' => $request['billing_address'][$key],
                'contact_type' => $request['contact_type'][$key],
                'address' => $request['address'][$key],
                'aptNo' => $request['aptNo'][$key],
                'city' => $request['city'][$key],
                'state' => $request['state'][$key],
                'zip' => $request['zip'][$key],
            ]);
        }


        return redirect()->route('customer.index')
            ->with('success', 'Customer created successfully');
    }

    //Customer Edit
    public function customer_edit($id)
    {
        $customer = Customer::find($id);
        $roles = Role::select(['id', 'name'])->where('name', 'user')->get();

        return view('admin.customer.edit', compact('customer', 'roles'));
    }

    //Customer Update
    public function customer_update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->route('customer.index')
            ->with('success', 'Customer updated successfully');
    }

    //Customer Destroy
    public function customer_destroy($id)
    {
        Customer::find($id)->delete();
        return redirect()->route('customer.index')
            ->with('success', 'Customer deleted successfully');
    }
    public function service_destroy($id)
    {
        StoredService::find($id)->delete();
        return redirect()->back()
            ->with('success', 'Service deleted successfully');
    }

    //User Create
    public function create()
    {
        $roles = Role::select(['id', 'name'])->get();
        return view('admin.users.create', compact('roles'));
    }

    //User Store
    public function store(Request $request)
    {
        // dd($request);
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
            ->with('success', 'User created successfully');
    }

    //User Show
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }

    //User Edit
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }

    //User Update
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    //User Destroy
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

}
