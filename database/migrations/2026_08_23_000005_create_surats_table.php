<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->cascadeOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->enum('jenis_surat', ['Surat Kematian', 'Surat Domisili', 'Surat Pengantar', 'Lainnya']);
            $table->string('perihal')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('status', ['Diajukan', 'Diproses', 'Disetujui', 'Ditolak', 'Selesai'])->default('Diajukan');
            $table->text('catatan_admin')->nullable();
            $table->date('tanggal_pengajuan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
