<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // /**
    //  * Run the migrations.
    //  */
    // public function up(): void
    // {
    //     Schema::create('jumlah_pendaftars', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('qism_id')->nullable()
    //             ->constrained()
    //             ->cascadeOnUpdate()
    //             ->nullOnDelete();
    //         $table->foreignId('kelas_id')->nullable()
    //             ->constrained()
    //             ->cascadeOnUpdate()
    //             ->nullOnDelete();
    //         $table->string('putra')->nullable();
    //         $table->string('putri')->nullable();
    //         $table->string('putra_diterima')->nullable();
    //         $table->string('putri_diterima')->nullable();
    //         $table->string('total')->nullable();
    //         $table->string('total_diterima')->nullable();
    //         $table->boolean('is_active')->nullable();
    //         $table->string('created_by')->nullable();
    //         $table->string('updated_by')->nullable();

    //         $table->timestamps();
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::dropIfExists('jumlah_pendaftars');
    // }
};
