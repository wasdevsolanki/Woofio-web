<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatus;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\QR;
use App\Models\User;
use Dompdf\Dompdf;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\ValidationException;

class OrderController extends Controller
{
    public function index($slug)
    {
        $data['orders'] = Order::with('users')->where('status', $slug)->orderBy('id', 'desc')->get();

        if ($slug == 'all') {
            $data['orders'] = Order::with('users')->get();
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

        return view('admin.order.index', $data);

    }

    public function OrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'status' => 'required',
        ]);

        $Order = Order::with('users')->where('id', $request->order_id)->first();

        if( !is_null($Order)) {
            $Order->update(['status'=>$request->status]);
            if( $Order && $Order->users->email != null ) {

                $data['email'] = $Order->users->email;
                $data['order_number'] = $Order->Order_Number;
                $data['quantity'] = $Order->quantity;
                $data['status'] = $Order->status;

                Mail::to($data['email'])->send(new OrderStatus($data));
            }

            return redirect()->back()->with('success', 'Order status updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function GenerateQR($id)
    {
        if ( ! is_null($id) && OrderExist($id) == false )
        {
            $query = Order::with('users')->where('id', $id)->first();
            $qty   = $query->quantity;
            $size  = $query->size;
            $generated = [];
            $html = '';

            for ($i = 1; $i <= $qty; $i++) {

                $randomString = Str::uuid()->toString();
                $baseUrl = URL::to('/scan') . '?scan_id=' . $randomString;

                // Push each generated URL into the $generated array
                $generated[] = $randomString;

                $qrCode = new QrCode($baseUrl);
                $qrCode->setSize($size);
                $qrCode->setMargin(10);

                $pngWriter = new PngWriter();
                $pngResult = $pngWriter->write($qrCode);
                $imageData = $pngResult->getString();

                // Append the QR code image to the HTML string
                $html .= '<img src="data:image/png;base64,' . base64_encode($imageData) . '">';
            }

            foreach( $generated as $key => $value ) {
                QR::create([
                    'Order_Id'  => $id,
                    'size'      => $size,
                    'code'      => $value,
                    'status'    => 'inactive'
                ]);
            }

            // Create a PDF
            $pdf = new Dompdf();
            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'landscape');
            $pdf->render();

            $fileName = $query->users->name . '___' . date('dMY') . '.pdf';
            return $pdf->stream($fileName);
        } else {
            return redirect()->back()->with( 'error','No Data Found!' );
        }

    }

    public function GeneratedDownload($id)
    {
        $id = Crypt::decrypt($id);
        $order = Order::with('users')->findOrFail($id);

        if (!is_null($order)) {

            $data['codes'] = QR::where('Order_Id', $order->id)->get()->toArray();
            return view ('admin.qrcode.download', $data);

        } else {
            return redirect()->back()->with('error', 'No Data Found!');
        }

        return redirect()->back()->with('erro', 'Something went wrong !');
    }

    //    public function GeneratedDownload($id)
    //        {
    //            $id = Crypt::decrypt($id);
    //            $order = Order::with('users')->findOrFail($id);
        
    //            if (!is_null($order)) {
    //                $html = '';
    //                $exist = QR::where('Order_Id', $order->id)->get();
        
    //                foreach ($exist as $item) {
    //                    $baseUrl = URL::to('/scan') . '?scan_id=' . $item->code;
        
    //                    // Create QR code
    //                    $qrCode = QrCode::create($baseUrl)
    //                        ->setSize($item->size)
    //                        ->setMargin(10);
        
    //                    // Create generic logo
    //                    $logo = Logo::create('images/bg/petlogo.png')
    //                        ->setResizeToWidth(50)
    //                        ->setPunchoutBackground(true);
        
        
    //                    $pngWriter = new PngWriter();
    //                    $pngResult = $pngWriter->write($qrCode, $logo);
    //                    $imageData = $pngResult->getString();
        
    //                    // Append the QR code image to the HTML string
    //                    $html .= '<img src="data:image/png;base64,' . base64_encode($imageData) . '">';
    //                }
        
    //                // Create a PDF
    //                $pdf = new Dompdf();
    //                $pdf->loadHtml($html);
    //                $pdf->setPaper('A4', 'landscape');
    //                $pdf->render();
    //                $fileName = $order->users->name . '___' . date('dMY') . '.pdf';
        
    //                $pdf->stream($fileName);
    //                return redirect()->back()->with('success', 'Generated & downloaded successfully!');
    //            } else {
    //                return redirect()->back()->with('error', 'No Data Found!');
    //            }
    //    }


    public function SelfOrderCreate()
    {

        // $list = QR::distinct()->pluck('Order_Id');
        // $list = QR::where('Order_Id', '8')->get();
        // dd($list);

        $data['users'] = User::where('role', 'vendor')->get();
        return view('admin.order.self_order', $data);
    }

    public function SelfOrder(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'quantity' => 'required|max:1000',
            'size' => 'required',
        ]);

        $quantity = $request->quantity;
        $size = $request->size;
        $note = $request->note;
        $user = User::find($request->user_id);

        $generated = [];
        $html = '';

        if ($quantity > 0 && $size != null) {

            for ( $i = 1;  $i <= $quantity; $i++ ) {

                $randomString = Str::uuid()->toString();
                $baseUrl = URL::to('/scan') . '?scan_id=' . $randomString;

                // Push each generated URL into the $generated array
                $generated[] = $randomString;

                $qrCode = new QrCode($baseUrl);
                $qrCode->setSize($size);
                $qrCode->setMargin(10);


                $pngWriter = new PngWriter();
                $pngResult = $pngWriter->write($qrCode);
                $imageData = $pngResult->getString();

                // Append the QR code image to the HTML string
                $html .= '<img src="data:image/png;base64,' . base64_encode($imageData) . '">';

            }

            if ( $generated != null ) {

                $order = Order::create([
                    'Order_Number'  =>  $this->generateRandomString(10),
                    'user_id'       =>  $user->id,
                    'quantity'      =>  $quantity,
                    'size'          =>  $size,
                    'note'          =>  $note
                ]);

                if( $order ){
                    foreach( $generated as $key => $value ) {
                        QR::create([
                            'Order_Id'  => $order->id,
                            'size'      => $size,
                            'code'      => $value,
                            'status'    => 'inactive'
                        ]);
                    }
                }

            } else {
                return redirect()->back()->with('error', 'Something went wrong!');
            }

            // Create a PDF
            $pdf = new Dompdf();
            $pdf->loadHtml($html);
            $pdf->setPaper('A4', 'landscape');
            $pdf->render();
            $fileName = $user->name . '___' . date('dMY') . '.pdf';

            return $pdf->stream($fileName);

        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

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
