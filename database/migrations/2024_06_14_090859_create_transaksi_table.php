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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("anggota_id")->nullable(false);
            $table->bigInteger("nominal")->nullable(false);
            $table->unsignedBigInteger("jenis_transaksi_id")->nullable(false);
            $table->timestamps();
            $table->foreign("anggota_id")->references("id")->on("anggota");
            $table->foreign("jenis_transaksi_id")->references("id")->on("jenis_transaksi");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
