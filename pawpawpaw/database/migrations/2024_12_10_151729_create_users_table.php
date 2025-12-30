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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nama', 100)->unique();
            $table->string('nik')->unique();
            $table->string('no_telp');
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->boolean('aktif_praktek')->default(true);
            $table->string('lokasi_praktek')->nullable();   
            $table->string('kontak')->nullable();           
            $table->enum('role', ['PATIENT', 'DOCTOR', 'ADMIN']);
            $table->unsignedBigInteger('id_specialization')->nullable();
            $table->foreign('id_specialization')->references('id_specialization')->on('specializations')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
