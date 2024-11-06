<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class QR extends Model
{
    protected $table = 'qrcode';
    use HasFactory;
    protected $fillable = [
        'code',
        'image',
        'size',
        'status',
        'Order_Id',
    ];
    public function orders()
    {
        return $this->belongsTo(Order::class,'Order_Id');
    }
}
