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
        Schema::create('tb_nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa'); // id_siswa int [ref: > tb_siswa.id]
            $table->unsignedBigInteger('id_mapel'); // id_mapel int [ref: > tb_mapel.id]
            $table->decimal('nilai', 5, 2); // nilai decimal(5,2)
            $table->enum('semester', ['Ganjil', 'Genap']); // semester enum [note: "Ganjil, Genap"]
            $table->timestamps(); // created_at timestamp, updated_at timestamp

            // Foreign key constraints
            $table->foreign('id_siswa')->references('id')->on('tb_siswa')->onDelete('cascade');
            $table->foreign('id_mapel')->references('id')->on('tb_mapel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_nilai_siswa');
    }
};
