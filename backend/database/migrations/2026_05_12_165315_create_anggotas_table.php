<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggotas', function (Blueprint $table) {

            $table->id();

            $table->string('nama');

            $table->string('email')->unique();

            $table->string('pac');

            $table->string('profesi');

            $table->string('telepon')->nullable();

            $table->string('pendidikan');

            $table->enum('status', [
                'aktif',
                'tidak_aktif',
            ]);

            $table->date('tanggal_bergabung');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
