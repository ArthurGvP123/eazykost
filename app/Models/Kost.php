<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'price_daily',   // Baru
        'price_monthly', // Baru
        'price_yearly',  // Baru
        'room_total',
        'location',
        'address',
        'image',
        'is_available',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI GAMBAR (Penting)
    public function images()
    {
        return $this->hasMany(KostImage::class, 'kost_id', 'id');
    }

    public function rentRequests()
    {
        return $this->hasMany(RentRequest::class);
    }
}