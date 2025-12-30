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
        Schema::create('consultation_cancellations', function (Blueprint $table) {
            $table->id('id_pembatalan');
            $table->unsignedBigInteger('id_konsultasi');
            $table->unsignedBigInteger('id_user_admin');
            $table->date('tanggal_pembatalan');
            $table->string('alasan', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_konsultasi')->references('id_konsultasi')->on('consultations')->onDelete('cascade');
            $table->foreign('id_user_admin')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_cancellations');
    }
};
