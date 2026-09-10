<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('pacs', 'tanggal_kedaluwarsa')) {
            Schema::table('pacs', function (Blueprint $table) {
                $table->date('tanggal_kedaluwarsa')->nullable()->after('tanggal_berdiri');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pacs', 'tanggal_kedaluwarsa')) {
            Schema::table('pacs', function (Blueprint $table) {
                $table->dropColumn('tanggal_kedaluwarsa');
            });
        }
    }
};
