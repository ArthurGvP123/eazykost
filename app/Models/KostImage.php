<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KostImage extends Model
{
    use HasFactory;
    protected $table = 'kost_images';
    protected $fillable = ['kost_id', 'image_path', 'sort_order']; // <--- Tambahkan sort_order

    public function kost() { return $this->belongsTo(Kost::class); }
}