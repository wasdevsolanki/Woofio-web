<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Models\QR;
use App\Models\Pet;
use App\Models\User;
use App\Models\Order;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\ScanQR;
use App\Mail\DenyLocation;

class QRController extends Controller
{
    public function create(){
        
        $active = QR::where('status', 'active')->count();
        $inactive = QR::where('status', 'inactive')->count();
        return view('admin.qrcode.create', compact('active','inactive'));
    }

    public function generateQRCode(Request $request){

        $request->validate([
            'quantity' => 'required',
            'qr_size' => 'required',
        ]);

        $quantity = $request->input('quantity');
        $qr_size = $request->input('qr_size');

        // dd($quantity);

        $qrCodes = [];
        $qr_list = [];

        for ($i = 0; $i < $quantity; $i++) {
            //$randomString = Str::random(20).Str::random(10);
            $randomString = Str::uuid()->toString();
            $baseUrl = URL::to('/').'/scan?scan_id='.$randomString;

            $text = $i;
            $qrCode = new QrCode($baseUrl);
            $qrCode->setSize($qr_size);

            $qrCode->setMargin(10);

            $pngWriter = new PngWriter();
            $pngResult = $pngWriter->write($qrCode);

            $imageData = $pngResult->getString();
            $qrCodes[] = base64_encode($imageData);
            $qr_list[] = $randomString;
        }

        return view('admin.qrcode.print', compact('qrCodes', 'quantity', 'qr_size', 'qr_list'));
    }

    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'Items' => 'required',
            'qrsize' => 'required',

        ]);

        $qrCodesArray = json_decode($request->input('Items'), true);
        $request['Items'] = $qrCodesArray;

        $Items = $request->input('Items');
        $qrsize = $request->input('qrsize');
        

        foreach ($Items as $qr) {
            $Item = new Qr;
            $Item->code = $qr['qrList'];
            // $Item->image = $qr['qrCode'];
            $Item->size = $qrsize;
            $Item->save();
        }

        // Return a response or redirect as needed
        return response()->json(['message' => 'Values stored successfully']);
    }

    public function ScanQR(Request $request){

        $request->validate([
            'scan_id' => 'required',
        ]);

        $scan_id = $request->input('scan_id');
        $exist = QR::where('code', $scan_id)->first();

        if( $exist && $exist->Order_Id ) {

            if(Auth::user() && Auth::user()->role ==  "vendor"){
                Auth::logout();
            }
            $order = Order::with('users')->where('id', $exist->Order_Id)->first();
            // if( $order && $order->users->status == 0 ) {
            //     return redirect()->route('login');
            // }

        } else {
            return redirect()->route('login');
        }

        if ($exist->status == 'inactive' && $request->view != 'public') {
            session()->put('scan_id', $request->scan_id);
        }

        if( Auth::user() && $exist->status == 'inactive' && $request->view != 'public' ){
            // session()->put('scan_id', $request->scan_id);
            return redirect('/user?qr_id='.$scan_id);
        }

        $check = QR::where('code', $scan_id)->where('status','inactive')->first();
        $error = 'active';

        if (! empty($check->id) ) {
            $qr_id = $check->id;
            return view('front.verify', compact('qr_id','scan_id'));

        } elseif($scan_id) {

            $CheckQr = DB::table('qrcode')->where('code', $scan_id)->first();
            $qrExists = DB::table('pets')->where('qr_id', $CheckQr->id)->first();

            if ($qrExists) {

                $pet = Pet::with('users', 'qrcodes', 'vaccines')
                    ->where('user_id', $qrExists->user_id)
                    ->where('qr_id', $qrExists->qr_id)
                    ->first();

                return view('front.petinfo', compact('pet'));
            }

        } else {
            return view('front.index', compact('error'));
        }
    }
    
    public function ScanLocation(Request $request)
    {
        $data = $request->url;
        $email = $request->email;
        
        if($data != null && $email != null){
             Mail::to($email)->send(new ScanQR($data));
             // Mail::to('wasdevdzn@gmail.com')->send(new ScanQR($data));
        }

    }
    
    public function ScanLocationDeny(Request $request)
    {
        
        $data = $request->email;
        
        if( $data != null)
        {
            Mail::to($data)->send(new DenyLocation($data));
            
        }
        
        
    }
    
    
}
