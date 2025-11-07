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
        // Membuat tabel tasks untuk menyimpan tugas yang bisa diambil oleh pengguna lain
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul tugas
            $table->text('description'); // Deskripsi tugas
            $table->integer('reward_points'); // Poin hadiah untuk menyelesaikan tugas
            $table->foreignId('requester_id')->constrained('users')->onDelete('cascade'); // Pengguna yang membuat tugas
            $table->foreignId('helper_id')->nullable()->constrained('users')->onDelete('set null'); // Pengguna yang menyelesaikan tugas
            $table->enum('status', ['pending', 'accepted', 'done'])->default('pending'); // Status tugas
            $table->timestamp('accepted_at')->nullable(); // Waktu tugas diterima
            $table->timestamp('completed_at')->nullable(); // Waktu tugas selesai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};