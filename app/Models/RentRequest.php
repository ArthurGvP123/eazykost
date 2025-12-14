<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Izinkan semua kolom diisi kecuali ID

    // Relasi ke User (Penyewa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Kost
    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }
}