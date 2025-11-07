<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all existing messages that don't have a conversation_id
        $messages = DB::table('messages')->whereNull('conversation_id')->get();
        
        foreach ($messages as $message) {
            // Find or create conversation between sender and receiver
            $userOneId = min($message->sender_id, $message->receiver_id);
            $userTwoId = max($message->sender_id, $message->receiver_id);
            
            $conversation = DB::table('conversations')
                ->where('user_one_id', $userOneId)
                ->where('user_two_id', $userTwoId)
                ->first();
            
            if (!$conversation) {
                $conversationId = DB::table('conversations')->insertGetId([
                    'user_one_id' => $userOneId,
                    'user_two_id' => $userTwoId,
                    'created_at' => $message->created_at,
                    'updated_at' => $message->updated_at,
                ]);
            } else {
                $conversationId = $conversation->id;
            }
            
            // Update message with conversation_id
            DB::table('messages')
                ->where('id', $message->id)
                ->update(['conversation_id' => $conversationId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this data migration
    }
};
