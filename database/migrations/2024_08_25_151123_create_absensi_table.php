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
        Schema::create('tb_absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')
                ->constrained('tb_siswa') // Sets up foreign key constraint
                ->onDelete('cascade'); // Optional: Defines action on related record deletion
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']); // Assuming status options

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_absensi');
    }
};
