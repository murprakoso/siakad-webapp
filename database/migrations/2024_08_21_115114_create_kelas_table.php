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
        Schema::create('tb_kelas', function (Blueprint $table) {
            $table->id(); // id dengan tipe int(11) dan auto increment
            $table->string('nama_kelas', 200); // nama_kelas dengan tipe varchar(200)
            $table->string('tingkat', 20); // tingkat dengan tipe varchar(20), menyimpan X, XI, XII
            $table->foreignId('wali_kelas_id') // wali_kelas_id dengan tipe int yang merupakan foreign key
                ->constrained('tb_guru') // referensi ke tabel tb_guru
                ->onDelete('cascade'); // jika guru dihapus, maka kelas terkait juga dihapus
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kelas');
    }
};
