<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ipl_id')->constrained('ipls')->cascadeOnDelete();
            $table->foreignId('warga_id')->constrained('wargas')->cascadeOnDelete();
            $table->decimal('nominal', 12, 2);
            $table->string('metode')->default('Transfer DANA');
            $table->string('bukti_pembayaran')->nullable();
            $table->date('tanggal_bayar');
            $table->enum('status', ['Menunggu Verifikasi', 'Disetujui', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
