<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('home');
    }

    public function userList()
    {
        $data['users'] = User::where('role', 'vendor')->orderBy('id', 'desc')->get();
        return view('admin.user.index', $data);
    }
    public function StoreUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|min:6',
            'gender' => 'required|in:male,female,other',
        ]);

        $user = User::Create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
            'gender' => $request->gender,
            'role'  => 'vendor'
        ]);

        return redirect()->back()->with('success', 'User has been created!');

    }

    public function DeleteUser($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $order = Order::where('user_id',$id)->first();

        if ( $user && is_null($order)){
            $user->delete();
            return redirect()->back()->with('success', 'User has deleted!');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }

    }

    public function StatusUser($id)
    {
        $id = Crypt::decrypt($id);
        if( $id ) {

            $user = User::findOrFail($id);
            if( $user->status == 1 ) {
                $user->update(['status' => 0 ]);
            } else {
                $user->update(['status' => 1 ]);
            }

            return redirect()->back()->with('success', 'Status changed successfully.');
        } else {
            return redirect()->back()->with('error', 'something went wrong!');
        }
    }
}
