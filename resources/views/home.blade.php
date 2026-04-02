@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 space-y-32">
    <!-- Hero Section -->
    <section class="min-h-screen flex flex-col items-center justify-center text-center relative pt-20">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-neon-blue/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute top-1/3 left-1/4 w-[300px] h-[300px] bg-neon-purple/20 rounded-full blur-[100px] animate-float"></div>
        </div>
        
        <div class="relative z-10 fade-in">
            <h2 class="text-xs font-orbitron tracking-[0.5em] text-neon-blue mb-6 uppercase opacity-70">Initialize System... OK</h2>
            <h1 class="text-6xl md:text-9xl font-orbitron font-black mb-8 leading-tight">
                <span class="neon-text-blue flicker">PORTFOLIO</span><br>
                <span class="text-white">RENO</span><span class="neon-text-purple"> ADITAMA</span>
            </h1>
            <p class="max-w-2xl mx-auto text-gray-400 font-poppins text-lg mb-12 leading-relaxed">
                Crafting digital experiences through code and gaming logic. 
                Siswa SMAK Frateran dengan visi di bidang <span class="text-neon-blue">Informatika</span> & <span class="text-neon-purple">Game Dev</span>.
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="#profile" class="btn-gaming btn-gaming-blue">VIEW PROFILE</a>
                <a href="{{ route('projects.index') }}" class="btn-gaming btn-gaming-purple">EXPLORE PROJECTS</a>
            </div>
        </div>
    </section>

    <!-- Profile Section -->
    <section id="profile" class="fade-in scroll-mt-32">
        <div class="relative group">
            <!-- Animated Background behind profile -->
            <div class="absolute -inset-1 bg-gradient-to-r from-neon-blue via-neon-purple to-neon-pink rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
            
            <div class="relative glassmorphism glassmorphism-blur p-8 md:p-16 rounded-[2rem] overflow-hidden">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <!-- Photo Side -->
                    <div class="flex flex-col items-center space-y-8">
                        <div class="relative">
                            <div class="w-64 h-64 md:w-80 md:h-80 rounded-full p-2 bg-gradient-to-tr from-neon-blue to-neon-purple animate-spin-slow">
                                <div class="w-full h-full rounded-full bg-dark-bg p-1">
                                    @if($profile->profile_image)
                                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-dark-card rounded-full text-neon-blue">
                                            <i class="fas fa-user-astronaut text-7xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Status Badge -->
                            <div class="absolute bottom-6 right-6 w-8 h-8 bg-green-500 rounded-full border-4 border-dark-bg shadow-[0_0_15px_#22c55e]"></div>
                        </div>

                        <div class="flex flex-col w-full gap-4">
                            <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="w-full">
                                @csrf
                                <input type="file" name="photo" id="photo" class="hidden" onchange="this.form.submit()">
                                <button type="button" onclick="document.getElementById('photo').click()" class="btn-gaming btn-gaming-blue w-full flex items-center justify-center gap-3">
                                    <i class="fas fa-cloud-upload-alt"></i> UPLOAD PHOTO
                                </button>
                            </form>
                            @if($profile->profile_image)
                            <form action="{{ route('profile.delete-photo') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="btn-gaming btn-gaming-purple w-full flex items-center justify-center gap-3">
                                    <i class="fas fa-trash-alt"></i> REMOVE PHOTO
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>

                    <!-- Info Side -->
                    <div class="flex-1 space-y-10">
                        <div class="space-y-4 text-center lg:text-left">
                            <h3 class="text-xs font-orbitron tracking-[0.4em] text-neon-purple uppercase">Identity Verified</h3>
                            <h2 class="text-5xl md:text-6xl font-orbitron font-black text-white leading-tight">
                                {{ strtoupper($profile->name) }}
                            </h2>
                            <div class="flex flex-wrap justify-center lg:justify-start gap-4 text-sm font-orbitron tracking-widest text-neon-blue">
                                <span class="px-4 py-1 glassmorphism border-neon-blue/30 rounded-full">{{ $profile->school }}</span>
                                <span class="px-4 py-1 glassmorphism border-neon-purple/30 rounded-full">CLASS {{ $profile->class }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="glassmorphism p-6 rounded-2xl border-white/5 group/card hover:border-neon-blue/50 transition-colors">
                                <p class="text-[10px] font-orbitron text-gray-500 mb-2 uppercase tracking-tighter">Current Age</p>
                                <p class="text-2xl font-orbitron font-bold text-white">{{ $profile->age }} <span class="text-neon-blue text-sm">Years Old</span></p>
                            </div>
                            <div class="glassmorphism p-6 rounded-2xl border-white/5 group/card hover:border-neon-purple/50 transition-colors">
                                <p class="text-[10px] font-orbitron text-gray-500 mb-2 uppercase tracking-tighter">Date of Birth</p>
                                <p class="text-2xl font-orbitron font-bold text-white">{{ \Carbon\Carbon::parse($profile->birth_date)->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h4 class="font-orbitron text-sm tracking-widest text-gray-400 uppercase">Biography</h4>
                            <p class="text-gray-400 leading-relaxed text-lg font-light italic">
                                "{{ $profile->description }}"
                            </p>
                        </div>

                        <div class="flex justify-center lg:justify-start space-x-6 pt-4">
                            <a href="https://instagram.com/reno_aditamaaa" target="_blank" class="text-2xl text-gray-500 hover:text-neon-blue transition-all hover:scale-125">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://wa.me/62878797471192" target="_blank" class="text-2xl text-gray-500 hover:text-neon-purple transition-all hover:scale-125">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack Section -->
    <section class="fade-in">
        <div class="text-center mb-20">
            <h2 class="text-4xl font-orbitron font-black text-white mb-4 flicker">TECH STACK</h2>
            <p class="text-gray-500 font-orbitron text-xs tracking-[0.3em] uppercase">Core Technologies & Tools</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
            @php
                $techs = [
                    ['name' => 'C++', 'icon' => 'devicon-cplusplus-plain colored', 'color' => 'blue'],
                    ['name' => 'C#', 'icon' => 'devicon-csharp-plain colored', 'color' => 'purple'],
                    ['name' => 'Python', 'icon' => 'devicon-python-plain colored', 'color' => 'blue'],
                    ['name' => 'Unity', 'icon' => 'devicon-unity-original', 'color' => 'white'],
                    ['name' => 'Laravel', 'icon' => 'devicon-laravel-original colored', 'color' => 'purple'],
                    ['name' => 'SQLite', 'icon' => 'devicon-sqlite-plain colored', 'color' => 'blue'],
                    ['name' => 'HTML5', 'icon' => 'devicon-html5-plain colored', 'color' => 'blue'],
                    ['name' => 'CSS3', 'icon' => 'devicon-css3-plain colored', 'color' => 'blue'],
                    ['name' => 'JavaScript', 'icon' => 'devicon-javascript-plain colored', 'color' => 'blue'],
                    ['name' => 'TailwindCSS', 'icon' => 'devicon-tailwindcss-original colored', 'color' => 'blue'],
                    ['name' => 'Git', 'icon' => 'devicon-git-plain colored', 'color' => 'blue'],
                    ['name' => 'GitHub', 'icon' => 'devicon-github-original', 'color' => 'white'],
                ];
            @endphp

            @foreach($techs as $tech)
            <div class="tech-card neon-border-{{ $tech['color'] == 'white' ? 'blue' : $tech['color'] }}">
                <div class="text-5xl mb-2 group-hover:scale-110 transition-transform duration-300">
                    <i class="{{ $tech['icon'] }}"></i>
                </div>
                <span class="font-orbitron text-[10px] tracking-widest text-gray-400 uppercase group-hover:text-white transition-colors">{{ $tech['name'] }}</span>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Domains Section -->
    <section class="fade-in pb-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Web Dev Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-neon-blue to-cyan-500 rounded-[2rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative glassmorphism p-12 rounded-[2rem] overflow-hidden">
                    <div class="flex items-start justify-between mb-8">
                        <div class="w-20 h-20 glassmorphism rounded-2xl flex items-center justify-center border-neon-blue/30 text-neon-blue">
                            <i class="fas fa-code text-4xl"></i>
                        </div>
                        <span class="font-orbitron text-[10px] tracking-[0.4em] text-neon-blue">DOMAIN 01</span>
                    </div>
                    <h3 class="text-4xl font-orbitron font-black text-white mb-6 leading-tight">WEBSITE<br>DEVELOPMENT</h3>
                    <p class="text-gray-400 text-lg font-light leading-relaxed mb-10">
                        Architecting robust and scalable web applications using modern stacks like Laravel and TailwindCSS. Focused on clean code and pixel-perfect UI.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-blue border-neon-blue/20">LARAVEL</span>
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-blue border-neon-blue/20">TAILWIND</span>
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-blue border-neon-blue/20">MYSQL</span>
                    </div>
                </div>
            </div>

            <!-- Game Dev Card -->
            <div class="group relative">
                <div class="absolute -inset-1 bg-gradient-to-r from-neon-purple to-pink-500 rounded-[2rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <div class="relative glassmorphism p-12 rounded-[2rem] overflow-hidden">
                    <div class="flex items-start justify-between mb-8">
                        <div class="w-20 h-20 glassmorphism rounded-2xl flex items-center justify-center border-neon-purple/30 text-neon-purple">
                            <i class="fas fa-gamepad text-4xl"></i>
                        </div>
                        <span class="font-orbitron text-[10px] tracking-[0.4em] text-neon-purple">DOMAIN 02</span>
                    </div>
                    <h3 class="text-4xl font-orbitron font-black text-white mb-6 leading-tight">UNITY GAME<br>DEVELOPMENT</h3>
                    <p class="text-gray-400 text-lg font-light leading-relaxed mb-10">
                        Bringing virtual worlds to life using Unity Engine. Specialized in 2D/3D mechanics, physics, and immersive gameplay experiences.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-purple border-neon-purple/20">UNITY</span>
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-purple border-neon-purple/20">C#</span>
                        <span class="px-4 py-2 glassmorphism rounded-lg text-[10px] font-orbitron text-neon-purple border-neon-purple/20">SHADERS</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 12s linear infinite;
    }
</style>
@endsection
