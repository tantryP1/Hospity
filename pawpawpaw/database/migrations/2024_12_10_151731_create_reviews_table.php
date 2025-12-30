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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('id_review');
            $table->unsignedBigInteger('id_user_patient');
            $table->unsignedBigInteger('id_user_doctor');
            $table->integer('rating')->check('rating BETWEEN 1 AND 5');
            $table->string('komentar', 200)->nullable();
            $table->date('tanggal_review');
            $table->string('admin_feedback', 200)->nullable();
            $table->date('tanggal_feedback')->nullable();
            $table->unsignedBigInteger('id_user_admin')->nullable();
            $table->timestamps();

            $table->foreign('id_user_patient')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_user_doctor')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_user_admin')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
