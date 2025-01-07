<?php

use App\Models\AktivitasPendidikan;
use App\Models\AnandaBerada;
use App\Models\BersediaTidak;
use App\Models\Cita;
use App\Models\Hafalan;
use App\Models\Hobi;
use App\Models\Jarakpp;
use App\Models\Jeniskelamin;
use App\Models\JenisPendaftar;
use App\Models\KartuKeluargaSamaDengan;
use App\Models\KebutuhanDisabilitas;
use App\Models\KebutuhanKhusus;
use App\Models\Kewarganegaraan;
use App\Models\MedsosAnanda;
use App\Models\MembiayaiSekolah;
use App\Models\MendaftarKeinginan;
use App\Models\MukimTidak;
use App\Models\StatusAdmPendaftar;
use App\Models\StatusPendaftaran;
use App\Models\StatusTempatTinggal;
use App\Models\TahapPendaftaran;
use App\Models\Transpp;
use App\Models\Waktutempuh;
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
        Schema::table('santris', function (Blueprint $table) {

            $table->string('ps_mendaftar_keinginan_lainnya')->nullable();
            $table->text('ps_peng_pend_agama')->nullable();
            $table->text('ps_peng_pend_formal')->nullable();
            $table->text('ps_kkes_sakit_serius_nama_penyakit')->nullable();
            $table->text('ps_kkes_terapi_nama_terapi')->nullable();
            $table->text('ps_kkes_kambuh_nama_penyakit')->nullable();
            $table->text('ps_kkes_alergi_nama_alergi')->nullable();
            $table->text('ps_kkes_pantangan_nama')->nullable();
            $table->text('ps_kkes_psikologis_kapan')->nullable();
            $table->text('ps_kkes_gangguan_kapan')->nullable();
            $table->text('ps_kkh_keberadaan_rumah_keg')->nullable();
            $table->text('ps_kkh_fasilitas_gawai_medsos')->nullable();
            $table->text('ps_kkh_fasilitas_gawai_medsos_daftar')->nullable();
            $table->text('ps_kkh_fasilitas_gawai_medsos_aktif')->nullable();
            $table->text('ps_kkh_medsos_group_nama')->nullable();
            $table->text('ps_kkh_bacaan')->nullable();
            $table->text('ps_kkh_bacaan_cara_dapat')->nullable();
            $table->text('ps_kkh_keberadaan_nama_mhd')->nullable();
            $table->text('ps_kkh_keberadaan_lokasi_mhd')->nullable();

            $table->foreignIdFor(Hafalan::class, 'hafalan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(JenisPendaftar::class, 'jenis_pendaftar_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(TahapPendaftaran::class, 'tahap_pendaftaran_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusPendaftaran::class, 'status_pendaftaran_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'tdk_hp_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'belum_nisn_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(MukimTidak::class, 'al_s_status_mukim_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkh_fasilitas_gawai_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kkh_fasilitas_gawai_medsos_menutup_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkh_medsos_group_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_sakit_serius_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_terapi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_kambuh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_alergi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_pantangan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_psikologis_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkes_gangguan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkm_bak_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkm_bab_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkm_cebok_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(KartuKeluargaSamaDengan::class, 'kartu_keluarga_sama_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkm_ngompol_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Kewarganegaraan::class, 'kewarganegaraan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'ps_kkm_disuapin_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Cita::class, 'cita_cita_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusAdmPendaftar::class, 'ps_kadm_status_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Hobi::class, 'hobi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_surat_subsidi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(KebutuhanKhusus::class, 'keb_khus_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_surat_kurang_mampu_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(KebutuhanDisabilitas::class, 'keb_dis_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Jarakpp::class, 'al_s_jarak_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_atur_keuangan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(MembiayaiSekolah::class, 'bya_sklh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Transpp::class, 'al_s_transportasi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_penentuan_subsidi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(StatusTempatTinggal::class, 'al_s_stts_tptgl_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Waktutempuh::class, 'al_s_waktu_tempuh_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(Jeniskelamin::class, 'jeniskelamin_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_hidup_sederhana_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(AnandaBerada::class, 'ps_kkh_keberadaan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(BersediaTidak::class, 'ps_kadm_kebijakan_subsidi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(MedsosAnanda::class, 'ps_kkh_medsos_sering_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(YaTidak::class, 'nomor_kip_memiliki_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignIdFor(MendaftarKeinginan::class, 'ps_mendaftar_keinginan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignIdFor(AktivitasPendidikan::class, 'aktivitaspend_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignIdFor(YaTidak::class, 'is_kk_baru')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('tahun_ajaran_id')->nullable()
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
