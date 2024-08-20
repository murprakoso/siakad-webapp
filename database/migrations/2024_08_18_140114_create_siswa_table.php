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
        Schema::create('tb_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agama'); // foreign key ke tb_agama.id
            $table->string('nisn')->unique()->notNullable();
            $table->string('nama_lengkap')->notNullable();
            $table->string('password')->notNullable();
            $table->timestamp('tanggal_masuk')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->notNullable();
            $table->text('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->notNullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->text('email')->nullable();
            $table->text('foto')->nullable();
            $table->text('asal_sekolah')->notNullable();
            $table->enum('jurusan', ['IPA', 'IPS'])->nullable();
            $table->enum('status', ['aktif', 'non-aktif'])->notNullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('id_agama')->references('id')->on('tb_agama')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_siswa');
    }
};
