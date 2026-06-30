<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            if (! Schema::hasColumn('anggotas', 'status_pernikahan')) {
                $table->string('status_pernikahan')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('anggotas', function (Blueprint $table) {
            if (Schema::hasColumn('anggotas', 'status_pernikahan')) {
                $table->dropColumn('status_pernikahan');
            }
        });
    }
};
