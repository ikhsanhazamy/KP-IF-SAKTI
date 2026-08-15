<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->index('status');
            $table->index('pac');
            $table->index('tanggal_bergabung');
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->index('status');
            $table->index('tanggal');
        });

        Schema::table('pacs', function (Blueprint $table) {
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['pac']);
            $table->dropIndex(['tanggal_bergabung']);
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['tanggal']);
        });

        Schema::table('pacs', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });
    }
};
