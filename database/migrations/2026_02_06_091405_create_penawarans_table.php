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
    Schema::create('penawarans', function (Blueprint $table) {
        $table->id();
        $table->string('no_surat')->unique(); // Validasi unik
        $table->string('mitra');
        $table->string('petani');
        // Komoditi kita fix-kan saja stringnya jika variatif, atau enum jika pasti
        $table->string('komoditi')->default('GKP AnyQuality'); 
        $table->string('kualitas')->nullable();
        $table->string('kemasan')->default('Curah');
        $table->decimal('harga', 15, 2);
        $table->date('tgl_penawaran');
        $table->integer('kuantum_kg');
        $table->decimal('nominal', 20, 2); // Total Harga
        $table->string('gudang')->nullable();
        $table->string('kode_erp')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawarans');
    }
};
