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
        // Bagian penawarans DIHAPUS saja karena sudah ada index uniknya
        
        // Kita fokus ke SPP saja
        Schema::table('spps', function (Blueprint $table) {
            $table->string('no_po')->nullable()->unique()->change();
        });
        }

        public function down()
        {
            Schema::table('spps', function (Blueprint $table) {
                $table->dropUnique(['no_po']);
            });
        }
};
