<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    protected $table = 'vaccine';
    use HasFactory;
    protected $fillable = [
        'pet_id',
        'vaccine_name',
        'vaccine_date',
        'vaccine_expiry_date',
        'veterinary_name',
        'detail',
        'status',
        'send_mail_status'
    ];
}