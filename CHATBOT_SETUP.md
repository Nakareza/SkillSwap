# 🤖 AI Chatbot Setup Guide - Google Gemini AI Integration

## 📋 Overview
AI Chatbot terintegrasi dengan Google Gemini AI untuk memberikan bantuan personal kepada user SkillSwap. **100% GRATIS!**

## ✨ Features
- 💬 Floating chat button dengan pulse animation
- 🎨 Modern chat UI dengan gradient design  
- 🤖 AI yang memahami context user (skills, points, rating, tasks)
- 💾 Chat history tersimpan di database
- ⌨️ Typing indicator saat AI berpikir
- 🗑️ Clear chat history
- 📱 Responsive design
- ✨ Smooth animations

## 🚀 Setup Instructions

### 1. Dapatkan Google Gemini API Key (GRATIS!)

#### Option A: Langsung dari AI Studio (Termudah)
1. Kunjungi: https://aistudio.google.com/app/apikey
2. Login dengan Google Account Anda
3. Klik **"Create API Key"**
4. Pilih atau buat Google Cloud Project
5. Copy API key yang generated (simpan dengan aman!)

#### Option B: Via Google Cloud Console
1. Buat project di: https://console.cloud.google.com/projectcreate
2. Enable Generative AI API: https://console.cloud.google.com/apis/library/generativelanguage.googleapis.com
3. Kembali ke AI Studio: https://aistudio.google.com/app/apikey
4. Create API Key dan pilih project yang dibuat

### 2. Update .env File
Buka file `.env` di root project dan update:

```env
GEMINI_API_KEY=AIzaSyCw6TH4zCIqCMOqx0HmeIz3B6o7LazP4VM
GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent
```

**API key sudah dikonfigurasi!**

### 3. Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
```

### 4. Test Chatbot
1. Login ke aplikasi
2. Lihat floating button di pojok kanan bawah dengan gradient biru-ungu-pink
3. Klik button untuk membuka chat window
4. Coba tanya sesuatu!

## 💡 Contoh Pertanyaan untuk AI

### Skill-related:
- "What skills should I learn to earn more points?"
- "Recommend me skills based on my profile"
- "How can I improve my offered skills?"

### Task-related:
- "Suggest some tasks for me to work on"
- "What kind of tasks should I create?"
- "How do I complete tasks faster?"

### Platform Guidance:
- "How does the point system work?"
- "How can I improve my rating?"
- "Tips to become a top helper"
- "How to get more reviews?"

### General:
- "Explain how SkillSwap works"
- "What are badges and how do I earn them?"
- "How to message other users?"

## 🎯 AI Context Awareness

AI chatbot akan mengetahui informasi user:
- ✅ Nama user
- ✅ Total points
- ✅ Rating (average_rating)
- ✅ Skills yang ditawarkan (offered skills)
- ✅ Skills yang dibutuhkan (needed skills)
- ✅ Jumlah tasks dibuat
- ✅ Jumlah tasks selesai

Jadi jawaban AI akan personal untuk setiap user!

## 🔧 Technical Details

### Database Schema
```sql
Table: chat_histories
- id: bigint
- user_id: bigint (foreign key to users)
- role: enum('user', 'assistant')
- content: text
- created_at: timestamp
- updated_at: timestamp
```

### API Endpoints
- `POST /chatbot/chat` - Send message to AI
- `DELETE /chatbot/clear` - Clear chat history
- `GET /chatbot` - View chat page (optional)

### Models Used
- **gemini-pro**: Google's powerful language model
- **temperature**: 0.7 (balanced creativity)
- **maxOutputTokens**: 500 (concise responses)
- **Cost**: 100% FREE! (60 requests per minute limit)

## 🎨 Customization

### Change AI Model
Edit `ChatbotController.php` - change URL to use different model:
```php
// gemini-pro (default) - Fast and free
'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent'

// gemini-pro-vision - For image understanding
'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro-vision:generateContent'
```

### Change Response Length
```php
'maxOutputTokens' => 1000, // longer responses
```

### Change AI Personality
Update system prompt di `ChatbotController.php`:
```php
'content' => "You are a [your custom personality]..."
```

## 🐛 Troubleshooting

### Error: "API request failed"
- ✅ Check API key benar
- ✅ Check API key masih aktif
- ✅ Check API limit belum habis
- ✅ Check internet connection

### Error: "Class 'GuzzleHttp\Client' not found"
```bash
composer require guzzlehttp/guzzle
```

### Chatbot button tidak muncul
- ✅ Check user sudah login (`@auth` required)
- ✅ Check `layouts/app.blade.php` include chatbot floating
- ✅ Clear cache: `php artisan view:clear`

### Chat history tidak tersimpan
- ✅ Check migration sudah run
- ✅ Check database connection
- ✅ Check `chat_histories` table exists

## 📊 Usage Statistics

Monitor chatbot usage:
```php
// Total chats per user
$chatCount = ChatHistory::where('user_id', $userId)->count();

// Most active users
$activeUsers = ChatHistory::select('user_id')
    ->groupBy('user_id')
    ->orderByRaw('COUNT(*) DESC')
    ->limit(10)
    ->get();
```

## 🔐 Security Notes

- ✅ API key disimpan di `.env` (never commit to git!)
- ✅ Add `.env` to `.gitignore`
- ✅ Rate limiting di route (optional):
  ```php
  Route::middleware(['auth', 'throttle:60,1'])->group(function () {
      Route::post('/chatbot/chat', ...);
  });
  ```

## 💰 Pricing Info

Google Gemini AI Pricing (as of 2025):
- **gemini-pro**: **100% FREE!** 🎉
- **Rate Limit**: 60 requests per minute (very generous!)
- **No credit card required**
- **No hidden fees**

Perfect for development and production use!

## 📝 Future Improvements

Potential enhancements:
- [ ] Voice input/output
- [ ] Multi-language support
- [ ] Suggested quick replies
- [ ] File upload for context
- [ ] Chat export (PDF/TXT)
- [ ] Admin analytics dashboard
- [ ] Sentiment analysis
- [ ] Auto-suggestions based on behavior

## 🎉 That's It!

Your AI Chatbot is ready! Users can now get intelligent help 24/7! 🚀

Questions? Check the code or ask me! 😊
