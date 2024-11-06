<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Pet;
use App\Models\QR;
use App\Models\User;


class VendorController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->pluck('id');
        $qr = QR::whereIn('Order_Id', $orders)->get()->pluck('id');
        $unused_qr = QR::whereIn('Order_Id', $orders)->where('status', 'inactive')->count();
        $pets = Pet::whereIn('qr_id', $qr)->get()->pluck('user_id');

        $data['unused_qr'] = $unused_qr;
        $data['OrderCount'] = $orders->count();
        $data['users'] = User::whereIn('id', $pets)->count();
        $data['pets'] = $pets->count();

        return view('vendor.home', $data);
    }
}
