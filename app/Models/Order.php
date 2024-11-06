<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    use HasFactory;
    protected $fillable = [
        'Order_Number',
        'user_id',
        'quantity',
        'size',
        'note',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
