<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Vaccine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class VaccineController extends Controller
{
    public function ShowVaccine(Request $request, $id)
    {
        $data = [];
        $data['pet'] = Pet::with('users')->where('id', $id)->where('user_id', Auth::id())->first();
        $data['vaccine'] = Vaccine::where('pet_id', $id)->latest()->get();
       
        return view('front.vaccine.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'vaccine_name' => 'required',
            'vaccine_date' => 'required',
            'vaccine_expiry_date' => 'required',
            // 'detail' => 'required',
            'veterinary_name' => 'required',
        ]);

        $vaccine = Vaccine::create([
            "pet_id" => $request->id,
            "vaccine_name" => $request->vaccine_name,
            "vaccine_date" => $request->vaccine_date,
            "vaccine_expiry_date" => $request->vaccine_expiry_date,
            "veterinary_name" => $request->veterinary_name,
            "detail" => 'NOT-AVAILABLE',
        ]);

        if( $vaccine ){
            return redirect()->back()->with('success', 'Vaccine is Added!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }
}
