<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pacs', function (Blueprint $table) {
            if (! Schema::hasColumn('pacs', 'alumni_lkd')) {
                $table->unsignedInteger('alumni_lkd')->default(0)->after('jumlah_anggota');
            }
        });

        if (Schema::hasColumn('pacs', 'Alumni_LKD')) {
            DB::table('pacs')->update([
                'alumni_lkd' => DB::raw('COALESCE(`Alumni_LKD`, 0)'),
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('pacs', function (Blueprint $table) {
            if (Schema::hasColumn('pacs', 'alumni_lkd')) {
                $table->dropColumn('alumni_lkd');
            }
        });
    }
};
