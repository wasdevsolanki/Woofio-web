<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index($slug)
    {
        $data['orders'] = Order::with('users')->where('status', $slug)->get();
        if ($slug == 'all') {
            $data['orders'] = Order::with('users')->where('user_id', Auth::id())->get();
            $data['slug'] = "All";
        } elseif( $slug == 0 ) {
            $data['slug'] = 'Pending';
        } elseif( $slug == 1 ) {
            $data['slug'] = 'Processing';
        } elseif( $slug == 2 ) {
            $data['slug'] = 'Shipped';
        } elseif( $slug == 3 ) {
            $data['slug'] = 'Delivered';
        } elseif( $slug == 4 ) {
            $data['slug'] = 'Canceled';
        } elseif( $slug == 5 ) {
            $data['slug'] = 'Return';
        } elseif( $slug == 6 ) {
            $data['slug'] = 'Payment Failed';
        } elseif( $slug == 7 ) {
            $data['slug'] = 'Delived Failed';
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        return view('vendor.pages.order.index', $data);
    }

    public function OrderCreate()
    {
        return view('vendor.pages.order.create');
    }

    public function OrderStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'quantity' => 'required',
            'size' => 'required',
        ]);

        $Order = Order::create([
            'Order_Number'  => $this->generateRandomString(8),
            'user_id'       => $request->user_id,
            'quantity'      => $request->quantity,
            'size'          => $request->size,
            'note'          => $request->note,
        ]);

        if($Order) {
            return redirect()->back()->with('success','Your have sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

    }

//    public  function generateRandomString($length = 20)
//    {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < $length; $i++) {
//            $randomString .= $characters[rand(0, $charactersLength - 1)];
//        }
//        return $randomString;
//    }

    public function generateRandomString($length = 8)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);

        do {
            $orderNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $orderNumber .= $characters[rand(0, $charactersLength - 1)];
            }
        } while (Order::where('Order_Number', $orderNumber)->exists());

        return $orderNumber;
    }

}
