<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kosts', function (Blueprint $table) {
            // Hapus kolom harga lama
            $table->dropColumn('price');
        
            // Tambah 3 kolom harga baru (Boleh Kosong / Nullable)
            $table->integer('price_daily')->nullable()->after('description');
            $table->integer('price_monthly')->nullable()->after('price_daily');
            $table->integer('price_yearly')->nullable()->after('price_monthly');
        });
    }
    
    public function down(): void
    {
        Schema::table('kosts', function (Blueprint $table) {
            $table->integer('price'); // Kembalikan kolom lama
            $table->dropColumn(['price_daily', 'price_monthly', 'price_yearly']);
        });
    }
};
