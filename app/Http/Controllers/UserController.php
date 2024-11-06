<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QR;
use App\Models\Pet;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile(Request $request){
        $scanId = session('scan_id');
        if($scanId){
            $request->qr_id = $scanId;
        }

        if($request->qr_id){
            $check = QR::where('code', $request->qr_id)->where('status', 'inactive')->first();
            if($check){
                $qr_id = $request->qr_id;
                $user = Auth::user() ?? null;
                $pets = Pet::where('user_id', $user->id)->latest()->get();
                return view('front.index', compact('qr_id', 'pets') );
            }
        }

        $user = Auth::user() ?? null;
        $pets = Pet::with('qrcodes')->where('user_id', $user->id)->latest()->get();
    
        return view('front.index', compact('pets'));
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');

        // Check if the email exists in the User table 
        $userExists = User::where('email', $email)->exists();

        return response()->json(['exists' => $userExists]);
    }

    public function RegisterUser(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'mobile' => 'required|string|max:20',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required|string|max:500',
        ]);

        $user = User::Create([
            'email' => $request->email,
            'password' => hash::make($request->password),
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'name' => $request->username,
            'gender' => $request->gender,
            'mobile' => $request->mobile,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
        ]);

        $qr = QR::where('code', $request->qr_id)
            ->where('status', 'inactive')
            ->first();
        $qr_id = $qr->code;

        //log in the user
        Auth::login($user);
        // return response()->json(['success' => true, 'qr_id' => $qr_id]);
        // return redirect('/user')->with('qr_id', $qr_id);
        return redirect()->to(url('/user?qr_id='.$qr_id));



    }

    public function LoginUser(Request $request){


        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $qr = QR::where('id', $request->qr_id)
            ->where('status', 'inactive')
            ->first();
        $qr_id = $qr->code;

        if (Auth::attempt($credentials)) {

            return response()->json(['success' => true, 'qr_id' => $qr_id]);
        } else {
            return response()->json(['message' => 'Password is invalid']);

        }
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('auth.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        // Update user profile
        $user = auth()->user();

        if ($request->hasFile('latest_profile') && $user->profile) {
            // Get the path of the old profile image
            $oldProfilePath = public_path('uploaded_files/user') . '/' . $user->profile;

            // Delete the old profile image
            if (file_exists($oldProfilePath)) {
                unlink($oldProfilePath);
            }
        }

        // Update user information
        $user->name = $validatedData['name'];
        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->gender = $validatedData['gender'];
        $user->mobile = $validatedData['mobile'];
        $user->address = $validatedData['address'];
        $user->email = $validatedData['email'];
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('latest_profile')) {
            $image = $request->file('latest_profile');
            $imagePetName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploaded_files/user'), $imagePetName);
            $user->profile = $imagePetName;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    public function guestVaccineLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        // Attempt to authenticate the user succesfull
        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            if( $user->role == "vendor" ) {

                $pet = Pet::where('id', $request->pet_id)->first();
                if($pet) {

                    $qr = QR::whereHas('orders', function ($query) {
                        $query->where('user_id', Auth::id());
                    })->with('orders')->where('id', $pet->qr_id)->first();

                    if($qr) {
                        return redirect()->route('vendor.client.pets.vaccine', ['id' => encrypt($pet->id)]);
                    } else {
                        return redirect()->back()->with('error', 'You can not access this pet info !');
                    }
                } else {
                    return redirect()->back()->with('error', 'Something went wrong!');
                }

            } elseif( $user->role == "user" ) {

                $pet = Pet::where('id', $request->pet_id)->where('user_id', Auth::id())->first();
                if($pet) {
                    return redirect()->route('vaccine.show', $pet->id);
                } else {
                    return redirect()->back()->with('error', 'Something went wrong!');
                }

            }

        }

        return redirect()->back()->with('error', 'Invalid credentials.');
    }

}
