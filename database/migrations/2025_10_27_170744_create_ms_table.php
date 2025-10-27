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
        Schema::create('ms', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['mahar', 'seserahan']);
            $table->string('nama', 100);
            $table->bigInteger('nominal')->nullable();
            $table->enum('status', ['Pending', 'Selesai'])->default('Pending');
            $table->text('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms');
    }
};
