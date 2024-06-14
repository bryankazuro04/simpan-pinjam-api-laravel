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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("nomor_induk", 100)->nullable(false);
            $table->string("nama", 100)->nullable(false);
            $table->string("alamat", 100)->nullable(false);
            $table->date("tanggal_lahir")->nullable(false);
            $table->string("no_hp")->nullable(false);
            $table->string("status")->nullable(false);
            $table->unsignedBigInteger("user_id")->nullable(false);
            $table->timestamps();
            //relasi
            $table->foreign("user_id")->on("users")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
