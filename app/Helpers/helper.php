<?php

use App\Models\QR;
use App\Models\Pet;
use App\Models\User;
use App\Models\Order;


if (!function_exists('OrderExist')) {
    function OrderExist($id) {
        return QR::where("Order_Id", $id)->exists();
    }
}

if (!function_exists('getPets')) {
    function getPets($id) {

        $qr = QR::whereHas('orders', function ($query) {
            $query->where('user_id', Auth::id());
        })
            ->with('orders')
            ->pluck('id');

        return Pet::with('qrcodes')->where('user_id', 76)->whereIn('qr_id', $qr)->get();
    }
}