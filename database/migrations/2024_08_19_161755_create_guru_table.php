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
        Schema::create('tb_guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agama'); // foreign key ke tb_agama.id
            $table->string('username')->unique(); // Not null
            $table->string('password'); // Not null
            $table->string('nama_lengkap'); // Not null
            $table->string('nip')->nullable(); // Default NULL
            $table->string('jabatan_akademik'); // Not null
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Enum values as per tb_dosen_jenis_kelamin_enum
            $table->string('tempat_lahir'); // Not null
            $table->date('tanggal_lahir'); // Not null
            $table->text('alamat')->nullable(); // Default NULL
            $table->string('no_hp')->nullable(); // Default NULL
            $table->string('email')->nullable(); // Default NULL
            $table->string('foto')->nullable(); // Default NULL
            $table->enum('status', ['Aktif', 'Non-aktif']); // Enum values as per tb_dosen_status_enum
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraint
            $table->foreign('id_agama')->references('id')->on('tb_agama')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_guru');
    }
};
