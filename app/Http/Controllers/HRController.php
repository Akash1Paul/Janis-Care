<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
class HRController extends Controller
{ 
    public function roles()
    {
        $layout = 0;
        $users = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '!=', 'customer')->orderBy('userdetails.created_at', 'DESC')->get();
        return view('hr.roles')->with(compact('layout', 'users'));
    }
    public function create_users()
    {
        $layout = 1;
        $territory = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'territory')->get();
        $relationship = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'relationship')->get();
        $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'runner')->get();
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'warehouse')->get();
        $vehicle = Vehicle::get();
        return view('hr.roles')->with(compact('territory', 'runner', 'vehicle', 'warehouse', 'layout', 'relationship'));
    }


    public function save_users(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'roles' => 'required',
            'email' => 'required|unique:userdetails|unique:users',
            'password' => 'required',
        ]);
        $userDetails = new UserDetail();
        $userDetails->name = $request->input('name');
        $userDetails->warename = $request->input('warename');
        $userDetails->email = $request->input('email');
        $userDetails->phone = $request->input('phone');
        $userDetails->workaddress = $request->input('workaddress');
        $userDetails->homeaddress = $request->input('homeaddress');
        $userDetails->pincode = $request->input('pincode');
        $userDetails->city = $request->input('city');
        $userDetails->spoc_name = $request->input('spoc_name');
        $userDetails->spoc_number = $request->input('spoc_number');
        $userDetails->showpassword = $request->input('password');
        $userDetails->warehouse = $request->input('warehouse');
        $userDetails->vehicle = $request->input('vehicle');
        $userDetails->runner = $request->input('runner');
        $userDetails->note = $request->input('note');
        $userDetails->territory_manager = $request->input('territory_manager');
        $userDetails->relationship_manager = $request->input('relationship_manager');
        $userDetails->empid = $request->input('empid');
        $userDetails->status = 'Approved';


        if ($request->hasfile('addressproof')) {
            $file = $request->file('addressproof');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->addressproof = $filename;
        }
        if ($request->hasfile('document')) {
            $file = $request->file('document');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->document = $filename;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userDetails->photo = $filename;
        }

        $userDetails->save();

        $user = new User();
        $user->roles = $request->input('roles');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Mail::send('email', ['email' => $request->email, 'password' => $request->password], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject('Welcome to our website');
        });
        return redirect('hr/roles')->with('status', 'User added successfully.');
    }


    public function edit_users($email_id)
    {
        $user = UserDetail::join('users', 'users.email', '=', 'userdetails.email')->where('userdetails.email', $email_id)->first();
        $products = Product::all();
        $territory = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'territory')->get();
        $relationship = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'relationship')->get();
        $runner = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'runner')->get();
        $warehouse = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', 'warehouse')->get();
        $vehicle = Vehicle::get();
        $layout = 2;
        return view('hr.roles')->with(compact('layout', 'user', 'products', 'territory', 'runner', 'vehicle', 'warehouse', 'relationship'));
    }


    public function update_users(Request $request, $email)
    {
        $userdetails = UserDetail::where('email', '=', $email)->first();
        $user = User::where('email', '=', $email)->first();
       

        // Update user details in userdetails table
        $userdetails->territory_manager = $request->territory_manager;
        $userdetails->relationship_manager = $request->relationship_manager;
        $userdetails->empid = $request->empid;
        $userdetails->name = $request->name;
        $userdetails->phone = $request->phone;
        $userdetails->city = $request->city;
        $userdetails->workaddress = $request->workaddress;
        $userdetails->homeaddress = $request->homeaddress;
        $userdetails->pincode = $request->pincode;
        $userdetails->warehouse = $request->warehouse;
        $userdetails->spoc_name = $request->spoc_name;
        $userdetails->spoc_number = $request->spoc_number;
        $userdetails->vehicle = $request->vehicle;
        $userdetails->runner = $request->runner;
        $userdetails->note = $request->note;
        $userdetails->showpassword = $request->input('password');
        if ($request->hasfile('addressproof')) {
            $file = $request->file('addressproof');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->addressproof = $filename;
        }
        if ($request->hasfile('document')) {
            $file = $request->file('document');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->document = $filename;
        }
        if ($request->hasfile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getclientoriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('image/', $filename);
            $userdetails->photo = $filename;
        }

        $userdetails->update();

        // Update name in users table
        $user->roles = $request->roles;
        $user->name = $request->name;
        $user->password = Hash::make($request->input('password'));
        $user->update();

        return redirect('hr/roles')->with('status', 'User Updated Successfully.');
    }


    public function delete_users(Request $request, $email)
    {
        UserDetail::where('email', $email)->delete();
        User::where('email', $email)->delete();
        return redirect('hr/roles')->with('delete', 'User Deleted.');
    }

    public function filterroles(Request $request)
    {

        $data = '';

        $roles = UserDetail::join('users', 'userdetails.email', '=', 'users.email')
            ->where('users.roles', '=', $request->roles)->get();

        foreach ($roles as $key => $value) {

            $Role = '';

            if ($value->roles == 'warehouse')
                $Role = 'Warehouse';
            elseif ($value->roles == 'admin')
                $Role = 'Admin';
            elseif ($value->roles == 'runner')
                $Role = 'Runner';
            elseif ($value->roles == 'relationship')
                $Role = 'Relationship Manager';
            elseif ($value->roles == 'customer')
                $Role = 'Customer';
            elseif ($value->roles == 'territory')
                $Role = 'Territory Manager';
            elseif ($value->roles == 'inventory')
                $Role = 'Inventory';
            $index = $key + 1;

            $data .= '
           <tr> 
            <td>' . $index . '</td>
            <td>' . date('d-m-Y', strtotime($value->created_at)) . '</td>
            <td>' . $value->name . '</td>
            <td>' . $Role . '</td>
            <td>' . $value->phone . '</td>
            <td>' . $value->email . '</td>
            <td>' . $value->showpassword . '</td>
         
       
            <td>
                <a
                href="' . url("superadmin/edit-users/" . $value->email) . '">
                <button type="button"
                    class="btn btn-primary waves-effect waves-light">Edit</button>
                </a>
                
                <a
                    href="' . url("superadmin/delete-users/" . $value->email) . '">
                    <button type="button" class="btn btn-danger waves-effect waves-light">Delete</button>
                </a>
            </td>
            </tr>';
        }


        return response()->json(['data' => $data]);
    }
}
