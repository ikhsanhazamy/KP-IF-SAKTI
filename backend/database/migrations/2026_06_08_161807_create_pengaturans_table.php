<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturans', function (Blueprint $table) {

            $table->id();

            $table->string('language')
                ->default('id');

            $table->string('timezone')
                ->default('Asia/Jakarta');

            $table->string('date_format')
                ->default('d-m-Y');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};