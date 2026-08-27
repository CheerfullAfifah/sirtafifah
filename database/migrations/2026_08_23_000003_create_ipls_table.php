<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ipls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('wargas')->cascadeOnDelete();
            $table->foreignId('rumah_id')->nullable()->constrained('rumahs')->nullOnDelete();
            $table->string('periode');
            $table->decimal('nominal', 12, 2);
            $table->date('tanggal_tagihan');
            $table->date('jatuh_tempo');
            $table->enum('status', ['Belum Bayar', 'Menunggu Verifikasi', 'Lunas'])->default('Belum Bayar');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ipls');
    }
};
