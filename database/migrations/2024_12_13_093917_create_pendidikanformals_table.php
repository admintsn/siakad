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
        Schema::create('pendidikanformals', function (Blueprint $table) {
            $table->id();
            $table->string('sort')->nullable();
            $table->foreignId('pengajar_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('pendidikan_terakhir_walisantri_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('nama_pf')->nullable();
            $table->foreignId('statuspf_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('alamat_pf')->nullable();
            $table->foreignId('jenispf_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('fakultas_pf')->nullable();
            $table->foreignId('jurusanpf_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('gelar_pf')->nullable();
            $table->foreignId('peletakangelarpf_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->date('tahun_masuk_pf')->nullable();
            $table->date('tahun_lulus_pf')->nullable();
            $table->string('nilai_rata_pf')->nullable();
            $table->date('tanggal_ijazah_pf')->nullable();
            $table->string('nomor_ijazah_pf')->nullable();
            $table->text('file_ijazah_pf')->nullable();
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
        Schema::dropIfExists('pendidikanformals');
    }
};
