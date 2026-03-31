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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telepon')->nullable()->after('email');
            $table->text('alamat')->nullable()->after('telepon');
            $table->string('nik', 20)->nullable()->after('alamat');
            $table->string('nip', 30)->nullable()->after('nik'); // for admin
            $table->string('foto_profil')->nullable()->after('nip');
            $table->string('instansi')->nullable()->after('foto_profil'); // for admin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telepon', 'alamat', 'nik', 'nip', 'foto_profil', 'instansi']);
        });
    }
};
