<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portfolio' }} - Albertus Reno Aditama</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        
        .page-transition {
            opacity: 0;
        }
    </style>
</head>
<body class="bg-dark-bg text-gray-200 grid-bg min-h-screen relative animated-bg-gradient">
    <!-- Page Loader -->
    <div id="loader" class="loader-wrapper">
        <div class="loader-content">
            <div class="loader-circle mx-auto mb-6"></div>
            <p class="font-orbitron text-xs tracking-[0.5em] text-neon-blue animate-pulse">LOADING SYSTEM...</p>
        </div>
    </div>

    <!-- Floating Particles Container -->
    <div id="particles-container" class="fixed inset-0 pointer-events-none z-0 overflow-hidden"></div>

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-500 py-6">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-orbitron font-black neon-text-blue tracking-tighter hover:scale-105 transition-transform">
                RENO<span class="text-neon-purple neon-text-purple">.</span>
            </a>
            
            <div class="hidden md:flex space-x-10 font-orbitron text-xs uppercase tracking-[0.2em]">
                <a href="{{ route('home') }}" class="underline-neon py-2 {{ request()->routeIs('home') ? 'text-neon-blue' : 'text-gray-400 hover:text-white' }} transition-colors">Home</a>
                <a href="{{ route('projects.index') }}" class="underline-neon-purple py-2 {{ request()->routeIs('projects.index') ? 'text-neon-purple' : 'text-gray-400 hover:text-white' }} transition-colors">Skills & Projects</a>
            </div>

            <div class="md:hidden">
                <button id="mobile-menu-btn" class="text-neon-blue">
                    <i data-lucide="menu" size="32"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden absolute top-full left-0 w-full glassmorphism p-6 flex-col space-y-4 font-orbitron text-center">
            <a href="{{ route('home') }}" class="block py-3 text-neon-blue">Home</a>
            <a href="{{ route('projects.index') }}" class="block py-3 text-neon-purple">Skills & Projects</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10 page-transition">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-32 py-20 border-t border-white/5 glassmorphism relative z-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="text-center md:text-left">
                    <h3 class="font-orbitron text-3xl font-black neon-text-blue mb-2">RENO<span class="text-neon-purple">.</span></h3>
                    <p class="text-gray-500 font-orbitron text-[10px] tracking-[0.3em] uppercase">Future Developer & Gamer</p>
                </div>
                
                <div class="flex flex-col items-center gap-6">
                    <h4 class="font-orbitron text-sm tracking-widest text-gray-400 uppercase">Connect With Me</h4>
                    <div class="flex space-x-8">
                        <a href="https://instagram.com/reno_aditamaaa" target="_blank" class="w-12 h-12 rounded-full glassmorphism flex items-center justify-center text-neon-blue hover:shadow-neon-blue hover:scale-110 transition-all border-neon-blue/30">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="https://wa.me/62878797471192" target="_blank" class="w-12 h-12 rounded-full glassmorphism flex items-center justify-center text-neon-purple hover:shadow-neon-purple hover:scale-110 transition-all border-neon-purple/30">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-20 pt-10 border-t border-white/5 text-center">
                <p class="text-gray-600 text-[10px] font-orbitron tracking-widest uppercase">&copy; {{ date('Y') }} ALBERTUS RENO ADITAMA. CODED WITH NEON.</p>
            </div>
        </div>
    </footer>

    <script>
        // Page Loader
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            const content = document.querySelector('.page-transition');
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.visibility = 'hidden';
                content.style.opacity = '1';
                content.classList.add('page-transition');
            }, 500);
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glassmorphism', 'py-4', 'shadow-[0_10px_30px_rgba(0,0,0,0.5)]');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('glassmorphism', 'py-4', 'shadow-[0_10px_30px_rgba(0,0,0,0.5)]');
                nav.classList.add('py-6');
            }
        });

        // Mobile Menu Toggle
        const menuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        menuBtn?.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('flex');
        });

        // Lucide icons
        lucide.createIcons();

        // Fade in on scroll observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

        // Create Floating Particles
        function createParticles() {
            const container = document.getElementById('particles-container');
            const isMobile = window.innerWidth < 768;
            const particleCount = isMobile ? 8 : 15;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                const size = Math.random() * 3 + 1;
                const left = Math.random() * 100;
                const duration = Math.random() * 10 + 10;
                const delay = Math.random() * 15;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${left}%`;
                particle.style.bottom = `-20px`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;
                
                container.appendChild(particle);
            }
        }
        createParticles();
    </script>
</body>
</html>
