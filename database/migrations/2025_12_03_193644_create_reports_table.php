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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            // Siapa yang lapor? (Pencari Kos)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Kos mana yang bermasalah?
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');
            
            $table->string('title');       // Judul keluhan (misal: Air Mati)
            $table->text('description');   // Detail keluhan
            $table->string('evidence')->nullable(); // Foto bukti (opsional)
            
            // Status laporan: pending, processed, resolved
            $table->enum('status', ['pending', 'resolved'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
