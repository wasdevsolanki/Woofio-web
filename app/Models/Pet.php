<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vaccine;
class Pet extends Model
{
    protected $table = 'pets';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'qr_id',
        'pet_name',
        'profile',
        'breed',
        'category',
        'gender',
        'special_instruction',
        'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function qrcodes()
    {
        return $this->belongsTo(QR::class,'qr_id');
    }
    public function vaccines()
    {
        return $this->hasMany(Vaccine::class, 'pet_id');
    }
}
