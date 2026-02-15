<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('spps', function (Blueprint $table) {
            // Kita tambahkan kolom-kolom titipan dari Penawaran
            $table->string('no_surat')->nullable()->after('mitra_kerja');
            $table->string('petani')->nullable()->after('no_surat');
            $table->string('komoditi')->nullable()->after('petani');
            $table->string('kualitas')->nullable()->after('komoditi');
            $table->string('kemasan')->nullable()->after('kualitas');
            $table->date('tgl_penawaran')->nullable()->after('kemasan');
        });
    }

    public function down()
    {
        Schema::table('spps', function (Blueprint $table) {
            $table->dropColumn(['no_surat', 'petani', 'komoditi', 'kualitas', 'kemasan', 'tgl_penawaran']);
        });
    }
};