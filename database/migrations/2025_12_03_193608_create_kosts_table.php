<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            // Relasi ke Pemilik Kos (users)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('name');           // Nama Kos
            $table->string('slug')->unique(); // Untuk link URL (misal: eazykost.com/kost-bahagia)
            $table->text('description');      // Deskripsi lengkap
            $table->integer('price');         // Harga per bulan
            $table->string('location');       // Lokasi (misal: Semarang)
            $table->string('address');        // Alamat lengkap
            $table->string('image')->nullable(); // Foto Kos
            $table->boolean('is_available')->default(true); // Status Penuh/Kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
