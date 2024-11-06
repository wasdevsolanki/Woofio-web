<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\QR;
use App\Models\Pet;
use App\Models\Order;
use App\Models\Vaccine;

class ClientController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get()->pluck('id');
        $qr = QR::whereIn('Order_Id', $orders)->get()->pluck('id');
        $pets = Pet::whereIn('qr_id', $qr)->get()->pluck('user_id');
        $data['users'] = User::whereIn('id', $pets)->get();

        return view('vendor.pages.client.index', $data);
    }

    public function getPets($id)
    {
        $id = Crypt::decrypt($id);
        $qr = QR::whereHas('orders', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('orders')->pluck('id');
        $data['user'] = User::where('id', $id)->first();
        $data['pets'] = Pet::with('qrcodes')->where('user_id', $id)->whereIn('qr_id', $qr)->get();
        return view('vendor.pages.client.pet', $data);
    }

    public function getPetVaccine($id)
    {
        $id = Crypt::decrypt($id);
        $data['pet'] = Pet::where('id', $id)->first();
        $data['vaccines'] = Vaccine::where('pet_id', $id)->get();
        return view('vendor.pages.client.vaccine', $data);
    }

    public function PetVaccineStore(Request $request)
    {
        $request->validate([
            'vaccine_name' => 'required',
            'vaccine_date' => 'required',
            'vaccine_expiry_date' => 'required',
            'veterinary_name' => 'required',
        ]);

        $vaccine = Vaccine::create([
            "pet_id" => $request->pet_id,
            "vaccine_name" => $request->vaccine_name,
            "vaccine_date" => $request->vaccine_date,
            "vaccine_expiry_date" => $request->vaccine_expiry_date,
            "veterinary_name" => $request->veterinary_name,
            "detail" => 'NOT-AVAILABLE',
        ]);

        if( $vaccine ) {
            return redirect()->back()->with('success', 'Vaccine has been added successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }
}
