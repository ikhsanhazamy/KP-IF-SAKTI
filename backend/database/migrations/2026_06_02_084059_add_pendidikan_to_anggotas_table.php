<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('anggotas', 'pendidikan')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->string('pendidikan')
                    ->nullable()
                    ->after('profesi');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('anggotas', 'pendidikan')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->dropColumn('pendidikan');
            });
        }
    }
};
