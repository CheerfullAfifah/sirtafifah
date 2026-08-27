<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rumahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->nullable()->constrained('wargas')->nullOnDelete();
            $table->string('nomor_rumah');
            $table->string('blok')->nullable();
            $table->string('nama_pemilik');
            $table->string('nama_penghuni')->nullable();
            $table->enum('status_hunian', ['Milik Sendiri', 'Sewa/Kontrak', 'Kosong'])->default('Milik Sendiri');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rumahs');
    }
};
