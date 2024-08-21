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
        Schema::create('tb_mapel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guru')->constrained('tb_guru')->onDelete('cascade'); // Relasi dengan tb_guru
            $table->string('kode_mapel', 20);
            $table->string('nama_mapel', 200);
            $table->enum('jurusan', ['IPA', 'IPS'])->nullable(); // Sesuaikan pilihan enum untuk jurusan
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_mapel');
    }
};
