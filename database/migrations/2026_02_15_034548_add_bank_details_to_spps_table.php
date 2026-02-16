<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('spps', function (Blueprint $table) {
            $table->string('nama_bank')->nullable();   // Contoh: BRI
            $table->string('no_rekening')->nullable(); // Contoh: 326001...
            $table->string('atas_nama')->nullable();   // Contoh: IR. SAID ANWAR
        });
    }

    public function down()
    {
        Schema::table('spps', function (Blueprint $table) {
            $table->dropColumn(['nama_bank', 'no_rekening', 'atas_nama']);
        });
    }
};
