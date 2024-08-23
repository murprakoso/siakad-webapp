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
        Schema::create('tb_keuangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->decimal('jumlah_pembayaran', 10, 2);
            $table->date('tanggal_pembayaran');
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas', 'menunggak']);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_siswa')->references('id')->on('tb_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_keuangan');
    }
};
