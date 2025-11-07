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
        // Add missing columns to messages table
        Schema::table('messages', function (Blueprint $table) {
            if (!Schema::hasColumn('messages', 'conversation_id')) {
                $table->foreignId('conversation_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('messages', 'attachment')) {
                $table->string('attachment')->nullable()->after('content');
            }
            if (!Schema::hasColumn('messages', 'read_at')) {
                $table->timestamp('read_at')->nullable()->after('is_read');
            }
        });

        // Add missing columns to reviews table
        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'helpful_count')) {
                $table->integer('helpful_count')->default(0)->after('feedback');
            }
            if (!Schema::hasColumn('reviews', 'is_visible')) {
                $table->boolean('is_visible')->default(true)->after('helpful_count');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove added columns from messages table
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'conversation_id')) {
                $table->dropForeign(['conversation_id']);
                $table->dropColumn('conversation_id');
            }
            if (Schema::hasColumn('messages', 'attachment')) {
                $table->dropColumn('attachment');
            }
            if (Schema::hasColumn('messages', 'read_at')) {
                $table->dropColumn('read_at');
            }
        });

        // Remove added columns from reviews table
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'helpful_count')) {
                $table->dropColumn('helpful_count');
            }
            if (Schema::hasColumn('reviews', 'is_visible')) {
                $table->dropColumn('is_visible');
            }
        });
    }
};
