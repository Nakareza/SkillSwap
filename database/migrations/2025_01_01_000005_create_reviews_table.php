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
        // Membuat tabel reviews untuk menyimpan ulasan dan rating setelah tugas selesai
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->onDelete('cascade'); // Tugas yang direview
            $table->foreignId('from_user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang memberi review
            $table->foreignId('to_user_id')->constrained('users')->onDelete('cascade'); // Pengguna yang menerima review
            $table->integer('rating')->between(1, 5); // Rating (1-5)
            $table->text('feedback')->nullable(); // Feedback teks
            $table->integer('helpful_count')->default(0); // Jumlah "helpful" votes
            $table->boolean('is_visible')->default(true); // Apakah review terlihat atau disembunyikan
            $table->timestamps();

            // Indexes untuk performance
            $table->index('to_user_id');
            $table->index('rating');
            $table->index(['to_user_id', 'is_visible']);
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