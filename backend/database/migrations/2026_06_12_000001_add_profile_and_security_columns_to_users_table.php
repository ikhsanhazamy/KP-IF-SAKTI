<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone', 30)->nullable()->after('email');
            $table->string('jabatan')->nullable()->after('phone');
            $table->string('photo')->nullable()->after('jabatan');
            $table->boolean('two_factor_enabled')->default(false)->after('photo');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'jabatan',
                'photo',
                'two_factor_enabled',
            ]);
        });
    }
};
