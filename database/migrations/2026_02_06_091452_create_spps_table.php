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
    Schema::create('spps', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel penawaran
            $table->foreignId('penawaran_id')->constrained('penawarans')->onDelete('cascade');
            
            // Data Copy Otomatis
            $table->string('mitra_kerja'); 
            $table->integer('kuantum'); 
            $table->decimal('harga', 15, 2); 
            $table->decimal('total_bayar', 20, 2);

            // Data Inputan Admin (Nanti di-Edit)
            // Kita buat nullable() semua karena pas awal dibuat, ini masih kosong
            $table->string('no_po')->nullable();
            $table->integer('tgl_po')->nullable(); 
            $table->string('bulan_po')->nullable(); 
            $table->date('tgl_hari_ini')->nullable(); // Tanggal cetak
            $table->string('pic')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spps');
    }
};
