<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\ChatHistory;

class ChatbotController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $history = ChatHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get()
            ->reverse()
            ->values();
        
        return view('chatbot.index', compact('history'));
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $userMessage = $request->message;

        // Save user message to history
        ChatHistory::create([
            'user_id' => $user->id,
            'role' => 'user',
            'content' => $userMessage,
        ]);

        // Build context about user
        $context = $this->buildUserContext($user);
        
        // Get recent conversation history for context
        $recentMessages = ChatHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->reverse()
            ->values();

        // Build conversation history
        $conversationHistory = '';
        foreach ($recentMessages as $msg) {
            $role = $msg->role === 'user' ? 'User' : 'Assistant';
            $conversationHistory .= "{$role}: {$msg->content}\n";
        }

        // Enhanced system prompt - supports general questions too!
        $systemPrompt = "You are a friendly and helpful AI assistant named SkillSwap AI. You can help with:\n\n";
        $systemPrompt .= "1. SkillSwap Platform Questions:\n{$context}\n";
        $systemPrompt .= "   - Give personalized advice about skills, tasks, and points\n";
        $systemPrompt .= "   - Provide tips to improve rating and success\n\n";
        $systemPrompt .= "2. General Questions:\n";
        $systemPrompt .= "   - Answer questions about any topic\n";
        $systemPrompt .= "   - Provide helpful information and explanations\n";
        $systemPrompt .= "   - Be conversational and friendly\n\n";
        $systemPrompt .= "Language Support:\n";
        $systemPrompt .= "   - If user asks in Indonesian (Bahasa Indonesia), respond in Indonesian\n";
        $systemPrompt .= "   - If user asks in English, respond in English\n";
        $systemPrompt .= "   - Match the user's language naturally\n\n";
        $systemPrompt .= "Guidelines:\n";
        $systemPrompt .= "   - Keep responses concise (max 200 words)\n";
        $systemPrompt .= "   - Use emojis occasionally to be engaging\n";
        $systemPrompt .= "   - Be encouraging and positive\n";
        $systemPrompt .= "   - If you don't know something, be honest\n\n";
        $systemPrompt .= "Recent conversation:\n{$conversationHistory}\n\n";
        $systemPrompt .= "User's new message: {$userMessage}";

        try {
            // Call Google Gemini AI API
            $apiKey = env('GEMINI_API_KEY');
            $apiUrl = env('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent');
            
            \Log::info('Chatbot request', [
                'user_id' => $user->id,
                'message' => $userMessage,
                'api_url' => $apiUrl
            ]);

            $response = Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                ])
                ->post($apiUrl . '?key=' . $apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $systemPrompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                        'topK' => 40,
                        'topP' => 0.95,
                        'maxOutputTokens' => 800,
                    ],
                    'safetySettings' => [
                        [
                            'category' => 'HARM_CATEGORY_HARASSMENT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_HATE_SPEECH',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ],
                        [
                            'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                            'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                        ]
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                
                \Log::info('Chatbot response received', [
                    'response_data' => $data
                ]);
                
                // Extract AI response from Gemini format
                if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                    $aiMessage = $data['candidates'][0]['content']['parts'][0]['text'];
                } else {
                    // Check for blocked content
                    if (isset($data['candidates'][0]['finishReason']) && $data['candidates'][0]['finishReason'] === 'SAFETY') {
                        $aiMessage = "Maaf, saya tidak bisa menjawab pertanyaan tersebut karena alasan keamanan. Silakan tanya hal lain! 🙏";
                    } else {
                        $aiMessage = "Maaf, saya tidak bisa menghasilkan respon. Silakan coba lagi! 🙏";
                    }
                }
                
                // Save AI response to history
                ChatHistory::create([
                    'user_id' => $user->id,
                    'role' => 'assistant',
                    'content' => $aiMessage,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => $aiMessage,
                ]);
            } else {
                $errorBody = $response->body();
                \Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'body' => $errorBody
                ]);
                
                throw new \Exception('API request failed: ' . $errorBody);
            }
        } catch (\Exception $e) {
            \Log::error('Chatbot error: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'trace' => $e->getTraceAsString()
            ]);
            
            // Friendly fallback response
            $fallbackMessage = "Maaf, saya sedang mengalami kendala teknis. 😔\n\n";
            $fallbackMessage .= "Sementara itu, berikut beberapa tips:\n";
            $fallbackMessage .= "• Lihat Tasks yang tersedia di menu Tasks\n";
            $fallbackMessage .= "• Tambahkan skills di halaman Profile\n";
            $fallbackMessage .= "• Earn points dengan menyelesaikan tasks!\n\n";
            $fallbackMessage .= "Silakan coba lagi sebentar lagi! 🙏";
            
            return response()->json([
                'success' => true, // Changed to true for better UX
                'message' => $fallbackMessage,
            ]);
        }
    }

    private function buildUserContext($user)
    {
        $context = "User Information:\n";
        $context .= "- Name: {$user->name}\n";
        $context .= "- Points: {$user->points}\n";
        $context .= "- Rating: " . number_format($user->average_rating, 1) . "/5.0\n";
        
        // User skills
        $offeredSkills = $user->offeredSkills->pluck('name')->toArray();
        $neededSkills = $user->neededSkills->pluck('name')->toArray();
        
        if (!empty($offeredSkills)) {
            $context .= "- Skills they offer: " . implode(', ', $offeredSkills) . "\n";
        }
        if (!empty($neededSkills)) {
            $context .= "- Skills they need: " . implode(', ', $neededSkills) . "\n";
        }

        // Task statistics
        $tasksCreated = $user->createdTasks()->count();
        $tasksCompleted = $user->acceptedTasks()->where('status', 'done')->count();
        $context .= "- Tasks created: {$tasksCreated}\n";
        $context .= "- Tasks completed: {$tasksCompleted}\n";

        return $context;
    }

    public function clearHistory()
    {
        ChatHistory::where('user_id', Auth::id())->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Chat history cleared successfully.',
        ]);
    }
}
