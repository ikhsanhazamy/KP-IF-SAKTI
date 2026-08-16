<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacs', function (Blueprint $table) {

            $table->id();

            $table->string('nama_pac');
            $table->string('kecamatan');

            $table->string('status')->default('aktif');

            $table->date('tanggal_berdiri');

            $table->text('alamat')->nullable();
            $table->string('desa')->nullable();
            $table->string('kode_pos')->nullable();

            $table->string('ketua_pac')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();

            $table->integer('jumlah_anggota')->default(0);

            $table->text('deskripsi')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pacs');
    }
};
