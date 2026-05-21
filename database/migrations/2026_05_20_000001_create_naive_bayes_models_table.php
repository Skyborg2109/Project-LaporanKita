<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel untuk menyimpan frekuensi kata per kategori (hasil training)
        Schema::create('naive_bayes_words', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');       // Kelas/kategori laporan
            $table->string('kata');            // Kata (token)
            $table->unsignedInteger('frekuensi')->default(1); // Frekuensi kemunculan kata
            $table->timestamps();

            $table->unique(['kategori', 'kata']); // Satu kata satu baris per kategori
        });

        // Tabel untuk menyimpan statistik per kelas
        Schema::create('naive_bayes_classes', function (Blueprint $table) {
            $table->id();
            $table->string('kategori')->unique();      // Nama kategori
            $table->unsignedInteger('jumlah_dokumen'); // Jumlah dokumen training di kelas ini
            $table->unsignedInteger('total_kata');     // Total kata di kelas ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('naive_bayes_words');
        Schema::dropIfExists('naive_bayes_classes');
    }
};
