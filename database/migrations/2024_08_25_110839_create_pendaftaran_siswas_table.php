<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_pendaftaran_siswa_baru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->date('tanggal_pendaftaran');
            $table->enum('status', ['terdaftar', 'ditolak', 'diterima']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_siswa')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pendaftaran_siswa_baru');
    }
};
