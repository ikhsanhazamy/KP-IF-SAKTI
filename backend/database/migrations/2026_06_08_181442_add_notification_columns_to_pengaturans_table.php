<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {

            $table->boolean('email_notification')
                ->default(true);

            $table->boolean('kegiatan_notification')
                ->default(true);

            $table->boolean('anggota_notification')
                ->default(true);

            $table->boolean('pac_notification')
                ->default(false);

        });
    }

    public function down(): void
    {
        Schema::table('pengaturans', function (Blueprint $table) {

            $table->dropColumn([
                'email_notification',
                'kegiatan_notification',
                'anggota_notification',
                'pac_notification'
            ]);

        });
    }
};