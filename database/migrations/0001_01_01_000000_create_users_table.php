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
        // Membuat tabel users (dengan kolom tambahan dari SkillSwap)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); // Dibutuhkan oleh Breeze
            $table->string('password');
            $table->text('bio')->nullable();           // Kolom dari SkillSwap
            $table->integer('points')->default(100);   // Kolom dari SkillSwap
            $table->integer('reputation')->default(0); // Kolom dari SkillSwap
            $table->double('average_rating', 3, 2)->default(0.00); // Kolom dari SkillSwap
            $table->rememberToken(); // Dibutuhkan oleh Breeze
            $table->timestamps(); // Dibutuhkan oleh Laravel
        });

        // Membuat tabel password_reset_tokens (dari Breeze)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Membuat tabel sessions (dari Breeze)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index(); // Kolom dari Breeze
            $table->string('ip_address', 45)->nullable(); // Kolom dari Breeze
            $table->text('user_agent')->nullable(); // Kolom dari Breeze
            $table->longText('payload'); // Kolom dari Breeze
            $table->integer('last_activity')->index(); // Kolom dari Breeze
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