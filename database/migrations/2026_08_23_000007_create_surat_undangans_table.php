<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_undangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nomor');
            $table->enum('jenis_kegiatan', ['Kerja Bakti', 'Rapat RT', 'Kegiatan Warga', 'Lainnya']);
            $table->string('judul');
            $table->date('tanggal_acara');
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->text('isi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_undangans');
    }
};
