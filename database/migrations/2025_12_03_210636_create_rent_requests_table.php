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
        Schema::create('rent_requests', function (Blueprint $table) {
            $table->id();
            
            // Relasi: Ke Kos mana dia ingin sewa?
            $table->foreignId('kost_id')->constrained('kosts')->onDelete('cascade');
            
            // Relasi: Siapa yang ingin menyewa?
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Tambahkan 'contacted' ke dalam array enum
            $table->enum('status', ['pending', 'contacted', 'accepted', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_requests');
    }
};