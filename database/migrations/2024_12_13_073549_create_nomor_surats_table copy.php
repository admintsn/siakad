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
        Schema::table('nomor_surats', function (Blueprint $table) {
            $table->string('jumlah_lampiran')->nullable();
            $table->string('nama_manual')->nullable();
            $table->string('nik_manual')->nullable();
            $table->string('tempat_lahir_manual')->nullable();
            $table->string('tanggal_lahir_manual')->nullable();
            $table->string('nama_ayah_manual')->nullable();
            $table->string('nama_ibu_manual')->nullable();
            $table->string('nama_wali_manual')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('source')->nullable();

            $table->text('kepada')->nullable();
            $table->text('alamat_manual')->nullable();
            $table->text('keterangan_surat_lainnya')->nullable();
            $table->text('keterangan_surat_lainnya2')->nullable();
            $table->text('penandatangan')->nullable();
            $table->text('tanggal_pada_surat')->nullable();
            $table->text('tembusan_surat')->nullable();
        });
    }
};
