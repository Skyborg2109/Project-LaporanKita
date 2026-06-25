<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Insert default categories to maintain compatibility with existing reports
        DB::table('kategoris')->insert([
            ['nama' => 'Infrastruktur', 'slug' => 'infrastruktur', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kebersihan & Lingkungan', 'slug' => 'kebersihan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Ketertiban Umum', 'slug' => 'ketertiban', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Fasilitas Publik', 'slug' => 'fasilitas', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Lainnya', 'slug' => 'lainnya', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
