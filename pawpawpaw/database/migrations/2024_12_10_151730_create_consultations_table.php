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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('id_konsultasi');
            $table->unsignedBigInteger('id_user_patient');
            $table->unsignedBigInteger('id_user_doctor');
            $table->enum('status', ['PENDING', 'COMPLETED', 'CANCELLED'])->default('PENDING');
            $table->timestamps();

            $table->foreign('id_user_patient')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_user_doctor')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
