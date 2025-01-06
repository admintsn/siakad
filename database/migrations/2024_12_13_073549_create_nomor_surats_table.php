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
        Schema::create('nomor_surats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_surat')->nullable();
            $table->string('nomor')->nullable();
            $table->foreignId('lembaga_surat_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('qism_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('santri_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('tujuan_surat_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('jenis_surat_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('tahunhberjalan_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('bulan_masehi')->nullable();
            $table->foreignId('tahunmberjalan_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->string('perihal_surat')->nullable();
            $table->text('alamat_surat')->nullable();
            $table->text('file_raw')->nullable();
            $table->text('file_signed')->nullable();
            $table->boolean('is_confirmed')->nullable();
            $table->boolean('is_printed')->nullable();
            $table->boolean('is_signed')->nullable();
            $table->boolean('is_scanned')->nullable();
            $table->boolean('is_sent')->nullable();
            $table->boolean('is_needrevise')->nullable();
            $table->boolean('is_revised')->nullable();
            $table->boolean('is_active')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_surats');
    }
};
