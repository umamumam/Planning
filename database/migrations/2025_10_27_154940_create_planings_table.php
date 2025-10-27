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
        Schema::create('planings', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 100);
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->text('deskripsi');
            $table->text('alamat');
            $table->integer('budget');
            $table->date('tgl_kontak');
            $table->enum('status', ['Sudah dihubungi','Belum dihubungi','Pertimbangan','Selesai'])->default('Belum dihubungi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planings');
    }
};
