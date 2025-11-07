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
        // Membuat tabel messages untuk sistem chat antar pengguna
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade'); // Conversation yang terkait
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade'); // Pengirim pesan
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade'); // Penerima pesan
            $table->text('content'); // Isi pesan
            $table->string('attachment')->nullable(); // File attachment (optional)
            $table->boolean('is_read')->default(false); // Status pesan sudah dibaca
            $table->timestamp('read_at')->nullable(); // Waktu dibaca
            $table->timestamps();

            // Indexes for performance
            $table->index('conversation_id');
            $table->index(['receiver_id', 'is_read']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};