<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SkillSwap - Platform pertukaran skill terbaik di Indonesia.">
    <title>SkillSwap - Exchange Skills, Earn Rewards</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            background: #0a0a0f;
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Navigation Glassmorphism */
        .nav-glass {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(10, 10, 15, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        
        .nav-glass.scrolled {
            background: rgba(10, 10, 15, 0.95);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Glassmorphism Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(102, 126, 234, 0.3);
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(102, 126, 234, 0.15);
        }
        
        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 16px 40px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
        }
        
        .btn-outline {
            background: transparent;
            color: white;
            padding: 14px 32px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.4);
        }
        
        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .float {
            animation: float 6s ease-in-out infinite;
        }
        
        /* Fade In Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        
        /* Gradient Border */
        .gradient-border {
            position: relative;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 24px;
            padding: 2px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.3) 0%, rgba(118, 75, 162, 0.3) 100%);
        }
        
        .gradient-border-inner {
            background: #0a0a0f;
            border-radius: 22px;
            padding: 40px;
        }
        
        /* Number Counter */
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Section Spacing */
        .section {
            padding: 120px 0;
            position: relative;
        }
        
        /* Glow Effect */
        .glow {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.15;
            pointer-events: none;
        }
        
        .glow-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .glow-blue {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
    </style>
</head>
<body>


    <!-- Navigation -->
    <nav class="nav-glass" id="navbar">
        <div style="max-width: 1200px; margin: 0 auto; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center;">
            <!-- Logo -->
            <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: white;">
                <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
                    </svg>
                </div>
                <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.25rem;">SkillSwap</span>
            </a>
            
            <!-- Nav Links -->
            <div style="display: flex; align-items: center; gap: 40px;">
                <div style="display: flex; gap: 32px;">
                    <a href="#features" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-weight: 500; transition: color 0.3s;">Fitur</a>
                    <a href="#how" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-weight: 500; transition: color 0.3s;">Cara Kerja</a>
                    <a href="#testimonials" style="color: rgba(255, 255, 255, 0.7); text-decoration: none; font-weight: 500; transition: color 0.3s;">Testimoni</a>
                </div>
                
                <!-- Auth Buttons -->
                <div style="display: flex; gap: 12px;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section style="min-height: 100vh; display: flex; align-items: center; position: relative; padding-top: 80px; overflow: hidden;">
        <!-- Glow Effects -->
        <div class="glow glow-purple" style="top: -200px; left: -200px;"></div>
        <div class="glow glow-blue" style="bottom: -200px; right: -200px;"></div>
        
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px; width: 100%; position: relative; z-index: 1;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;">
                <!-- Left Content -->
                <div class="fade-in-up">
                    <div style="display: inline-block; background: rgba(102, 126, 234, 0.1); border: 1px solid rgba(102, 126, 234, 0.3); border-radius: 50px; padding: 8px 20px; margin-bottom: 24px;">
                        <span style="color: #667eea; font-size: 0.875rem; font-weight: 600;">🚀 Platform #1 di Indonesia</span>
                    </div>
                    
                    <h1 style="font-family: 'Poppins', sans-serif; font-size: 4rem; font-weight: 800; line-height: 1.1; margin-bottom: 24px; color: white;">
                        Tukar Skill,<br>
                        <span class="gradient-text">Raih Hadiah</span>
                    </h1>
                    
                    <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.6); line-height: 1.6; margin-bottom: 40px; max-width: 500px;">
                        Bergabunglah dengan ribuan orang yang belajar dan mengajar skill. Bagikan keahlianmu, pelajari hal baru.
                    </p>
                    
                    <div style="display: flex; gap: 16px; margin-bottom: 60px;">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size: 1.125rem;">Ke Dashboard</a>
                        @else
                            <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1.125rem;">Mulai Gratis</a>
                            <a href="#how" class="btn-outline" style="font-size: 1.125rem;">Pelajari</a>
                        @endauth
                    </div>
                    
                    <!-- Stats -->
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px;">
                        <div>
                            <div class="stat-number">10K+</div>
                            <div style="color: rgba(255, 255, 255, 0.5); font-size: 0.875rem;">Pengguna Aktif</div>
                        </div>
                        <div>
                            <div class="stat-number">50K+</div>
                            <div style="color: rgba(255, 255, 255, 0.5); font-size: 0.875rem;">Skill Ditukar</div>
                        </div>
                        <div>
                            <div class="stat-number">4.9</div>
                            <div style="color: rgba(255, 255, 255, 0.5); font-size: 0.875rem;">Rating</div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Visual -->
                <div class="float" style="position: relative;">
                    <!-- People2 Image - Pojok Kanan Atas -->
                    <div style="position: absolute; top: -50px; right: -200px; z-index: 2;">
                        <div style="position: relative;">
                            <!-- Glow effect di belakang people2 -->
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; height: 500px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; filter: blur(120px); opacity: 0.6; z-index: 0;"></div>
                            <img src="{{ asset('images/landingpage/people2.png') }}" alt="Learning Community" style="width: 500px; height: auto; position: relative; z-index: 1; filter: drop-shadow(0 40px 80px rgba(240, 147, 251, 0.4));">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Showcase Section (Bawah Hero) -->
    <section style="padding: 100px 40px; background: linear-gradient(180deg, #0a0a0f 0%, #0f0f1a 50%, #0a0a0f 100%); position: relative; overflow: hidden;">
        <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 1;">
            <!-- Section Title -->
            <div style="text-align: center; margin-bottom: 60px;">
                <span style="color: #667eea; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 2px;">Komunitas Kami</span>
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 800; color: white; margin: 16px 0;">
                    Belajar Bersama, <span class="gradient-text">Tumbuh Bersama</span>
                </h2>
                <p style="color: rgba(255, 255, 255, 0.5); font-size: 1.25rem; max-width: 700px; margin: 0 auto;">
                    Bergabung dengan ribuan pembelajar yang saling mendukung dan berkembang bersama
                </p>
            </div>

            <!-- Single Large Image with Content -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <!-- Left: Large Image (No Card) -->
                <div style="position: relative;">
                    <!-- Glow Effects Behind Image -->
                    <div style="position: absolute; top: -50px; right: -50px; width: 250px; height: 250px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; filter: blur(80px); opacity: 0.5; z-index: 0;"></div>
                    <div style="position: absolute; bottom: -50px; left: -50px; width: 250px; height: 250px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; filter: blur(80px); opacity: 0.5; z-index: 0;"></div>
                    
                    <!-- Image without border/card -->
                    <img src="{{ asset('images/landingpage/people1.png') }}" alt="SkillSwap Community" style="width: 100%; height: auto; position: relative; z-index: 1; opacity: 1; filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.5));">
                </div>

                <!-- Right: Content -->
                <div style="text-align: left;">
                    <div style="margin-bottom: 40px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                            <svg width="40" height="40" fill="white" viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 style="font-family: 'Poppins', sans-serif; font-size: 2rem; font-weight: 800; color: white; margin-bottom: 16px;">Komunitas yang Aktif & Suportif</h3>
                        <p style="color: rgba(255, 255, 255, 0.7); font-size: 1.125rem; line-height: 1.8; margin-bottom: 32px;">
                            Bertemu dengan ribuan pembelajar dari berbagai bidang. Tukar skill, berbagi pengalaman, dan tumbuh bersama dalam komunitas yang saling mendukung.
                        </p>
                    </div>

                    <!-- Features List -->
                    <div style="display: grid; gap: 20px; margin-bottom: 40px;">
                        <div style="display: flex; align-items: start; gap: 16px;">
                            <div style="width: 32px; height: 32px; background: rgba(102, 126, 234, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #667eea; font-size: 1.25rem;">✓</span>
                            </div>
                            <div>
                                <h4 style="font-weight: 700; color: white; margin-bottom: 4px;">10,000+ Pengguna Aktif</h4>
                                <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.95rem;">Komunitas yang terus berkembang setiap hari</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: start; gap: 16px;">
                            <div style="width: 32px; height: 32px; background: rgba(102, 126, 234, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #667eea; font-size: 1.25rem;">✓</span>
                            </div>
                            <div>
                                <h4 style="font-weight: 700; color: white; margin-bottom: 4px;">50+ Kategori Skill</h4>
                                <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.95rem;">Dari coding hingga cooking, semua ada di sini</p>
                            </div>
                        </div>

                        <div style="display: flex; align-items: start; gap: 16px;">
                            <div style="width: 32px; height: 32px; background: rgba(102, 126, 234, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <span style="color: #667eea; font-size: 1.25rem;">✓</span>
                            </div>
                            <div>
                                <h4 style="font-weight: 700; color: white; margin-bottom: 4px;">Rating 4.9/5.0</h4>
                                <p style="color: rgba(255, 255, 255, 0.6); font-size: 0.95rem;">Dipercaya oleh ribuan pengguna di Indonesia</p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    @auth
                        <a href="{{ route('match.index') }}" class="btn-primary" style="font-size: 1.125rem; display: inline-flex; align-items: center; gap: 8px;">
                            <span>Temukan Partner Belajar</span>
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1.125rem; display: inline-flex; align-items: center; gap: 8px;">
                            <span>Bergabung Sekarang</span>
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Decorative Glow -->
        <div class="glow glow-purple" style="top: 50%; left: 10%; transform: translate(-50%, -50%);"></div>
        <div class="glow glow-blue" style="top: 50%; right: 10%; transform: translate(50%, -50%);"></div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section" style="background: linear-gradient(180deg, #0a0a0f 0%, #0f0f1a 100%);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px;">
            <div style="text-align: center; margin-bottom: 80px;" class="fade-in-up">
                <span style="color: #667eea; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 2px;">Fitur Unggulan</span>
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 800; color: white; margin: 16px 0 24px;">
                    Kenapa <span class="gradient-text">SkillSwap</span>?
                </h2>
                <p style="font-size: 1.125rem; color: rgba(255, 255, 255, 0.5); max-width: 600px; margin: 0 auto;">
                    Platform terlengkap untuk pertukaran skill dan pembelajaran kolaboratif
                </p>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px;">
                <!-- Feature 1 -->
                <div class="glass-card" style="padding: 40px;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                            <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 12px;">AI Matching</h3>
                    <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">Sistem cerdas yang mencocokkan kamu dengan partner belajar sempurna berdasarkan skill dan minat.</p>
                </div>
                
                <!-- Feature 2 -->
                <div class="glass-card" style="padding: 40px;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                            <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 12px;">Sistem Poin</h3>
                    <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">Dapatkan poin untuk setiap skill yang kamu bagikan. Tukar dengan fitur premium atau request bantuan.</p>
                </div>
                
                <!-- Feature 3 -->
                <div class="glass-card" style="padding: 40px;">
                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 24px;">
                        <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 12px;">Sertifikasi</h3>
                    <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">Dapatkan badge dan sertifikat terverifikasi untuk setiap pencapaian yang kamu raih.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how" class="section" style="background: #0a0a0f; position: relative;">
        <div class="glow glow-purple" style="top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>
        
        <div style="max-width: 900px; margin: 0 auto; padding: 0 40px; position: relative; z-index: 1;">
            <div style="text-align: center; margin-bottom: 80px;">
                <span style="color: #667eea; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 2px;">Mudah & Cepat</span>
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 800; color: white; margin: 16px 0;">
                    Cara <span class="gradient-text">Kerjanya</span>
                </h2>
            </div>
            
            <div style="display: grid; gap: 40px;">
                <!-- Step 1 -->
                <div class="gradient-border">
                    <div class="gradient-border-inner" style="display: flex; align-items: center; gap: 32px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);">
                            <span style="font-size: 2rem; font-weight: 800; color: white; font-family: 'Poppins', sans-serif;">1</span>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 8px;">Buat Profil</h3>
                            <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">Daftar dan tambahkan skill yang kamu tawarkan serta skill yang ingin dipelajari.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 2 -->
                <div class="gradient-border">
                    <div class="gradient-border-inner" style="display: flex; align-items: center; gap: 32px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 10px 40px rgba(240, 147, 251, 0.4);">
                            <span style="font-size: 2rem; font-weight: 800; color: white; font-family: 'Poppins', sans-serif;">2</span>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 8px;">Temukan Match</h3>
                            <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">AI kami akan mencarikan partner belajar yang cocok dengan kebutuhanmu.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="gradient-border">
                    <div class="gradient-border-inner" style="display: flex; align-items: center; gap: 32px;">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 10px 40px rgba(79, 172, 254, 0.4);">
                            <span style="font-size: 2rem; font-weight: 800; color: white; font-family: 'Poppins', sans-serif;">3</span>
                        </div>
                        <div style="flex: 1;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 700; color: white; margin-bottom: 8px;">Mulai Belajar</h3>
                            <p style="color: rgba(255, 255, 255, 0.6); line-height: 1.6;">Hubungi match-mu dan mulai pertukaran skill dengan sistem poin yang fair.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="section" style="background: linear-gradient(180deg, #0a0a0f 0%, #0f0f1a 100%);">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 40px;">
            <div style="text-align: center; margin-bottom: 80px;">
                <span style="color: #667eea; font-weight: 600; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 2px;">Testimoni</span>
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 800; color: white; margin: 16px 0;">
                    Kata <span class="gradient-text">Mereka</span>
                </h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; margin-bottom: 60px;">
                <!-- Testimonial 1 -->
                <div class="glass-card" style="padding: 32px;">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <img src="https://i.pravatar.cc/64?img=12" alt="User" style="width: 56px; height: 56px; border-radius: 50%; border: 2px solid rgba(102, 126, 234, 0.5);">
                        <div>
                            <div style="font-weight: 600; color: white; margin-bottom: 4px;">Budi Santoso</div>
                            <div style="color: #667eea; font-size: 0.875rem;">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.7); line-height: 1.6; font-style: italic;">
                        "Platform terbaik! Saya belajar web dev sambil ngajarin fotografi. Komunitasnya luar biasa supportif."
                    </p>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="glass-card" style="padding: 32px;">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <img src="https://i.pravatar.cc/64?img=5" alt="User" style="width: 56px; height: 56px; border-radius: 50%; border: 2px solid rgba(240, 147, 251, 0.5);">
                        <div>
                            <div style="font-weight: 600; color: white; margin-bottom: 4px;">Sarah Wijaya</div>
                            <div style="color: #f093fb; font-size: 0.875rem;">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.7); line-height: 1.6; font-style: italic;">
                        "Sistem poin-nya genius! Saya bisa dapet mentor coding expert cuma dengan ngajarin bahasa Inggris."
                    </p>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="glass-card" style="padding: 32px;">
                    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                        <img src="https://i.pravatar.cc/64?img=8" alt="User" style="width: 56px; height: 56px; border-radius: 50%; border: 2px solid rgba(79, 172, 254, 0.5);">
                        <div>
                            <div style="font-weight: 600; color: white; margin-bottom: 4px;">Andi Pratama</div>
                            <div style="color: #4facfe; font-size: 0.875rem;">⭐⭐⭐⭐⭐</div>
                        </div>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.7); line-height: 1.6; font-style: italic;">
                        "Matchingnya akurat banget! Ketemu banyak orang hebat dan skill saya berkembang pesat."
                    </p>
                </div>
            </div>
            
            <div style="text-align: center;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary" style="font-size: 1.125rem;">Lihat Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary" style="font-size: 1.125rem;">Bergabung Sekarang</a>
                @endauth
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 120px 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.05\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.3;"></div>
        
        <div style="max-width: 800px; margin: 0 auto; text-align: center; position: relative; z-index: 1;">
            <h2 style="font-family: 'Poppins', sans-serif; font-size: 3.5rem; font-weight: 800; color: white; margin-bottom: 24px; line-height: 1.2;">
                Siap Memulai Perjalanan<br>Skill-mu?
            </h2>
            <p style="font-size: 1.25rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Bergabung dengan ribuan learner dan teacher. Gratis untuk memulai, tanpa biaya tersembunyi.
            </p>
            
            <div style="display: flex; justify-content: center; gap: 16px;">
                @auth
                    <a href="{{ route('dashboard') }}" style="background: white; color: #667eea; padding: 18px 48px; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 1.125rem; transition: all 0.3s ease; display: inline-block;">
                        Ke Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" style="background: white; color: #667eea; padding: 18px 48px; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 1.125rem; transition: all 0.3s ease; display: inline-block;">
                        Daftar Gratis Sekarang
                    </a>
                    <a href="{{ route('login') }}" style="background: transparent; color: white; border: 2px solid white; padding: 18px 48px; border-radius: 12px; font-weight: 700; text-decoration: none; font-size: 1.125rem; transition: all 0.3s ease; display: inline-block;">
                        Sudah Punya Akun
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: #0a0a0f; padding: 80px 40px 40px; border-top: 1px solid rgba(255, 255, 255, 0.05);">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 60px; margin-bottom: 60px;">
                <!-- Brand -->
                <div>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
                            </svg>
                        </div>
                        <span style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.25rem; color: white;">SkillSwap</span>
                    </div>
                    <p style="color: rgba(255, 255, 255, 0.5); line-height: 1.6; max-width: 300px;">
                        Platform pertukaran skill terkemuka yang menghubungkan learner dan teacher di seluruh Indonesia.
                    </p>
                </div>
                
                <!-- Links -->
                <div>
                    <h4 style="color: white; font-weight: 600; margin-bottom: 20px; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 1px;">Platform</h4>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <a href="#features" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Fitur</a>
                        <a href="#how" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Cara Kerja</a>
                        <a href="#testimonials" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Testimoni</a>
                    </div>
                </div>
                
                <div>
                    <h4 style="color: white; font-weight: 600; margin-bottom: 20px; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 1px;">Perusahaan</h4>
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        <a href="#" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Tentang</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Karir</a>
                        <a href="#" style="color: rgba(255, 255, 255, 0.6); text-decoration: none; transition: color 0.3s;">Kontak</a>
                    </div>
                </div>
                
                <div>
                    <h4 style="color: white; font-weight: 600; margin-bottom: 20px; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 1px;">Sosial</h4>
                    <div style="display: flex; gap: 16px;">
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                            <svg width="20" height="20" fill="rgba(255, 255, 255, 0.6)" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                            <svg width="20" height="20" fill="rgba(255, 255, 255, 0.6)" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s;">
                            <svg width="20" height="20" fill="rgba(255, 255, 255, 0.6)" viewBox="0 0 24 24">
                                <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div style="border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 32px; display: flex; justify-content: space-between; align-items: center; color: rgba(255, 255, 255, 0.4); font-size: 0.875rem;">
                <div>&copy; 2025 SkillSwap. All rights reserved.</div>
                <div style="display: flex; gap: 24px;">
                    <a href="#" style="color: rgba(255, 255, 255, 0.4); text-decoration: none;">Privacy</a>
                    <a href="#" style="color: rgba(255, 255, 255, 0.4); text-decoration: none;">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>