<?php

use App\Models\HubunganWali;
use App\Models\Kewarganegaraan;
use App\Models\PekerjaanUtamaWalisantri;
use App\Models\PendidikanTerakhirWalisantri;
use App\Models\PenghasilanWalisantri;
use App\Models\Statuskepemilikanrumah;
use App\Models\StatusWali;
use App\Models\StatusWalisantri;
use App\Models\WaktuDatangKembali;
use App\Models\YaTidak;
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
        Schema::table('walisantris', function (Blueprint $table) {

            $table->foreignIdFor(WaktuDatangKembali::class, 'waktu_datang_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(WaktuDatangKembali::class, 'waktu_kembali_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignIdFor(YaTidak::class, 'ak_nama_lengkap_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ak_tdk_hp_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ak_nomor_handphone_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ak_kk_sama_pendaftar_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'al_ak_tgldi_ln_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ik_nama_lengkap_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ik_tdk_hp_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ik_nomor_handphone_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ik_kk_sama_ak_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'al_ik_sama_ak_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusWalisantri::class, 'ak_status_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ik_kk_sama_pendaftar_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Kewarganegaraan::class, 'ak_kewarganegaraan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'al_ik_tgldi_ln_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PendidikanTerakhirWalisantri::class, 'ak_pend_terakhir_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'w_nama_lengkap_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PekerjaanUtamaWalisantri::class, 'ak_pekerjaan_utama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'w_tdk_hp_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PenghasilanWalisantri::class, 'ak_pghsln_rt_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'w_nomor_handphone_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Statuskepemilikanrumah::class, 'al_ak_stts_rmh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'w_kk_sama_pendaftar_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusWalisantri::class, 'ik_status_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'al_w_tgldi_ln_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Kewarganegaraan::class, 'ik_kewarganegaraan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PendidikanTerakhirWalisantri::class, 'ik_pend_terakhir_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PekerjaanUtamaWalisantri::class, 'ik_pekerjaan_utama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PenghasilanWalisantri::class, 'ik_pghsln_rt_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Statuskepemilikanrumah::class, 'al_ik_stts_rmh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusWali::class, 'w_status_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(HubunganWali::class, 'w_hubungan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Kewarganegaraan::class, 'w_kewarganegaraan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PendidikanTerakhirWalisantri::class, 'w_pend_terakhir_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PekerjaanUtamaWalisantri::class, 'w_pekerjaan_utama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(PenghasilanWalisantri::class, 'w_pghsln_rt_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Statuskepemilikanrumah::class, 'al_w_stts_rmh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignIdFor(YaTidak::class, 'ik_kajian_sama_ak_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('menginap_tidak_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignIdFor(YaTidak::class, 'is_kk_baru_id')->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->boolean('is_active')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
