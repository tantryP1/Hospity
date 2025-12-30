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
        Schema::create('queues', function (Blueprint $table) {
            $table->id('id_antrian');
            $table->unsignedBigInteger('id_user_patient');
            $table->unsignedBigInteger('id_user_doctor');
            $table->unsignedBigInteger('id_konsultasi');
            $table->enum('status', ['MENUNGGU', 'SELESAI', 'DIBATALKAN'])->default('MENUNGGU');
            $table->integer('no_antrian')->unique();
            $table->timestamps();

            $table->foreign('id_user_patient')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_user_doctor')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_konsultasi')->references('id_konsultasi')->on('consultations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
