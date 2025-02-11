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
        Schema::table('kelas_santris', function (Blueprint $table) {
            $table->string('kode_nomor_rapor')->nullable();
            $table->string('kode_nomor_ijazah')->nullable();
            $table->bigInteger('nomor_rapor')->nullable();
            $table->bigInteger('nomor_ijazah')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
