@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 space-y-32 pt-20">
    <!-- Skills Section -->
    <section id="skills" class="fade-in">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-orbitron font-black text-white mb-4 flicker">SKILLS & ABILITIES</h2>
            <p class="text-gray-500 font-orbitron text-xs tracking-[0.3em] uppercase">System Capabilities Matrix</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- Soft Skills -->
            <div class="space-y-10">
                <div class="flex items-center gap-4 border-l-4 border-neon-purple pl-6">
                    <h3 class="text-2xl font-orbitron font-bold text-white tracking-widest">SOFT SKILLS</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach(['Creativity', 'Problem Solving', 'Logical Thinking', 'Teamwork', 'Time Management', 'Communication'] as $skill)
                    <div class="tech-card neon-border-purple group/skill">
                        <div class="w-12 h-12 rounded-full glassmorphism flex items-center justify-center mb-2 group-hover/skill:shadow-neon-purple transition-all border-neon-purple/20">
                            <i class="fas fa-brain text-neon-purple"></i>
                        </div>
                        <span class="font-orbitron text-xs tracking-[0.2em] text-gray-400 group-hover/skill:text-white transition-colors">{{ strtoupper($skill) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tech Skills -->
            <div class="space-y-10">
                <div class="flex items-center gap-4 border-l-4 border-neon-blue pl-6">
                    <h3 class="text-2xl font-orbitron font-bold text-white tracking-widest">TECH PROFICIENCY</h3>
                </div>
                <div class="space-y-8">
                    @foreach([
                        ['name' => 'Web Development', 'level' => 85, 'icon' => 'fa-code'],
                        ['name' => 'Game Development', 'level' => 75, 'icon' => 'fa-gamepad'],
                        ['name' => 'UI/UX Design Basic', 'level' => 80, 'icon' => 'fa-pen-nib'],
                        ['name' => 'Database Basic', 'level' => 70, 'icon' => 'fa-database'],
                        ['name' => 'Algorithm Basic', 'level' => 90, 'icon' => 'fa-microchip'],
                        ['name' => 'Debugging', 'level' => 85, 'icon' => 'fa-bug']
                    ] as $skill)
                    <div class="space-y-3 group/progress">
                        <div class="flex justify-between items-end font-orbitron text-[10px] tracking-[0.2em] uppercase">
                            <div class="flex items-center gap-3">
                                <i class="fas {{ $skill['icon'] }} text-neon-blue opacity-50 group-hover/progress:opacity-100 transition-opacity"></i>
                                <span class="text-gray-400 group-hover/progress:text-white transition-colors">{{ $skill['name'] }}</span>
                            </div>
                            <span class="text-neon-blue font-bold">{{ $skill['level'] }}%</span>
                        </div>
                        <div class="h-1.5 w-full bg-white/5 rounded-full overflow-hidden p-[1px] border border-white/5">
                            <div class="h-full bg-gradient-to-r from-neon-blue/50 to-neon-blue shadow-[0_0_15px_rgba(0,243,255,0.5)] transition-all duration-1000 ease-out" style="width: {{ $skill['level'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="fade-in pb-32">
        <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-10">
            <div class="space-y-4">
                <h2 class="text-5xl font-orbitron font-black text-white flicker">PROJECT ARCHIVE</h2>
                <p class="text-gray-500 font-orbitron text-xs tracking-[0.3em] uppercase">Deployment Log & History</p>
            </div>
            <button onclick="openModal('addModal')" class="btn-gaming btn-gaming-purple flex items-center gap-4">
                <i class="fas fa-plus-circle"></i> ADD NEW PROJECT
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($projects as $project)
            <div class="group relative">
                <!-- Hover Glow -->
                <div class="absolute -inset-1 bg-gradient-to-r from-neon-blue to-neon-purple rounded-[2rem] blur opacity-0 group-hover:opacity-20 transition duration-500"></div>
                
                <div class="relative glassmorphism rounded-[2rem] overflow-hidden flex flex-col h-full border-white/5 group-hover:border-neon-blue/30 transition-all duration-500">
                    <!-- Image Container -->
                    <div class="h-64 relative overflow-hidden bg-dark-card">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-white/10 group-hover:text-neon-blue/20 transition-colors duration-500">
                                <i class="fas fa-terminal text-8xl"></i>
                            </div>
                        @endif
                        
                        <!-- Badges -->
                        <div class="absolute top-6 left-6 flex flex-col gap-2">
                            <span class="px-4 py-1 glassmorphism backdrop-blur-md rounded-lg text-[10px] font-orbitron tracking-widest uppercase border-white/10 {{ $project->type == 'Tugas' ? 'text-neon-blue border-neon-blue/30' : 'text-neon-purple border-neon-purple/30' }}">
                                {{ $project->type }}
                            </span>
                        </div>

                        <!-- Quick Actions Overlay -->
                        <div class="absolute inset-0 bg-dark-bg/60 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-6">
                            <button onclick="openEditModal({{ $project }})" class="w-12 h-12 rounded-full glassmorphism flex items-center justify-center text-neon-blue hover:bg-neon-blue hover:text-dark-bg transition-all">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('projects.delete', $project->id) }}" method="POST" onsubmit="return confirm('Erase this data permanently?')">
                                @csrf
                                <button type="submit" class="w-12 h-12 rounded-full glassmorphism flex items-center justify-center text-neon-purple hover:bg-neon-purple hover:text-dark-bg transition-all">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 flex-1 flex flex-col space-y-6">
                        <div class="space-y-2">
                            <div class="flex items-center gap-3 text-[10px] font-orbitron text-gray-500 tracking-widest uppercase">
                                <i class="far fa-calendar-alt text-neon-blue"></i>
                                <span>{{ \Carbon\Carbon::parse($project->date)->format('M Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-orbitron font-bold text-white group-hover:neon-text-blue transition-colors duration-500">{{ strtoupper($project->title) }}</h3>
                        </div>
                        
                        <p class="text-gray-400 text-sm leading-relaxed font-light line-clamp-3">
                            {{ $project->description }}
                        </p>

                        <div class="pt-6 mt-auto border-t border-white/5 flex items-center justify-between">
                            <span class="text-[10px] font-orbitron text-gray-600 tracking-[0.3em] uppercase">Access Status: Public</span>
                            <div class="flex space-x-1">
                                <div class="w-1 h-1 rounded-full bg-neon-blue shadow-neon-blue"></div>
                                <div class="w-1 h-1 rounded-full bg-neon-blue/30"></div>
                                <div class="w-1 h-1 rounded-full bg-neon-blue/10"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-32 text-center glassmorphism rounded-[2rem] border-dashed border-white/10 opacity-30">
                <i class="fas fa-folder-open text-7xl mb-8 text-gray-700"></i>
                <p class="font-orbitron tracking-[0.5em] text-gray-600 uppercase">Archive is currently empty</p>
            </div>
            @endforelse
        </div>
    </section>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6">
    <div class="absolute inset-0 bg-dark-bg/95 backdrop-blur-xl" onclick="closeModal('addModal')"></div>
    <div class="relative glassmorphism w-full max-w-xl rounded-[2.5rem] p-10 md:p-12 neon-border-purple overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-3xl font-orbitron font-black neon-text-purple">NEW PROJECT</h3>
            <button onclick="closeModal('addModal')" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Project Title</label>
                <input type="text" name="title" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-purple outline-none transition-all text-white font-poppins">
            </div>
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Description</label>
                <textarea name="description" required rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-purple outline-none transition-all text-white font-poppins"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Launch Date</label>
                    <input type="date" name="date" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-purple outline-none transition-all text-white font-poppins">
                </div>
                <div class="space-y-3">
                    <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Category</label>
                    <select name="type" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-purple outline-none transition-all text-white font-poppins appearance-none">
                        <option value="Tugas" class="bg-dark-bg">Tugas</option>
                        <option value="Hobi" class="bg-dark-bg">Hobi</option>
                    </select>
                </div>
            </div>
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Visual Identity (Image)</label>
                <div class="relative group/upload">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full bg-white/5 border border-dashed border-white/20 rounded-2xl py-8 flex flex-col items-center justify-center group-hover/upload:border-neon-purple/50 transition-all">
                        <i class="fas fa-cloud-upload-alt text-3xl mb-3 text-gray-600 group-hover/upload:text-neon-purple transition-colors"></i>
                        <span class="text-xs text-gray-500 font-orbitron tracking-widest uppercase">Click or Drag Image Here</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 flex gap-4">
                <button type="button" onclick="closeModal('addModal')" class="flex-1 py-4 glassmorphism rounded-2xl font-orbitron tracking-widest text-xs hover:bg-white/10 transition-all uppercase">Abort</button>
                <button type="submit" class="flex-1 py-4 bg-neon-purple text-dark-bg font-orbitron font-black tracking-[0.2em] rounded-2xl hover:shadow-[0_0_30px_rgba(188,19,254,0.6)] transition-all uppercase">Deploy</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6">
    <div class="absolute inset-0 bg-dark-bg/95 backdrop-blur-xl" onclick="closeModal('editModal')"></div>
    <div class="relative glassmorphism w-full max-w-xl rounded-[2.5rem] p-10 md:p-12 neon-border-blue overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-3xl font-orbitron font-black neon-text-blue">EDIT PROJECT</h3>
            <button onclick="closeModal('editModal')" class="text-gray-500 hover:text-white transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <form id="editForm" action="" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Project Title</label>
                <input type="text" name="title" id="edit_title" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-blue outline-none transition-all text-white font-poppins">
            </div>
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Description</label>
                <textarea name="description" id="edit_description" required rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-blue outline-none transition-all text-white font-poppins"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Launch Date</label>
                    <input type="date" name="date" id="edit_date" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-blue outline-none transition-all text-white font-poppins">
                </div>
                <div class="space-y-3">
                    <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Category</label>
                    <select name="type" id="edit_type" required class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-4 focus:border-neon-blue outline-none transition-all text-white font-poppins appearance-none">
                        <option value="Tugas" class="bg-dark-bg">Tugas</option>
                        <option value="Hobi" class="bg-dark-bg">Hobi</option>
                    </select>
                </div>
            </div>
            <div class="space-y-3">
                <label class="font-orbitron text-[10px] tracking-[0.3em] text-gray-500 uppercase">Update Visual (Optional)</label>
                <div class="relative group/upload">
                    <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full bg-white/5 border border-dashed border-white/20 rounded-2xl py-8 flex flex-col items-center justify-center group-hover/upload:border-neon-blue/50 transition-all">
                        <i class="fas fa-image text-3xl mb-3 text-gray-600 group-hover/upload:text-neon-blue transition-colors"></i>
                        <span class="text-xs text-gray-500 font-orbitron tracking-widest uppercase">Click or Drag to Replace Image</span>
                    </div>
                </div>
            </div>
            <div class="pt-6 flex gap-4">
                <button type="button" onclick="closeModal('editModal')" class="flex-1 py-4 glassmorphism rounded-2xl font-orbitron tracking-widest text-xs hover:bg-white/10 transition-all uppercase">Cancel</button>
                <button type="submit" class="flex-1 py-4 bg-neon-blue text-dark-bg font-orbitron font-black tracking-[0.2em] rounded-2xl hover:shadow-[0_0_30px_rgba(0,243,255,0.6)] transition-all uppercase">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function openEditModal(project) {
        const form = document.getElementById('editForm');
        form.action = `/projects/update/${project.id}`;
        
        document.getElementById('edit_title').value = project.title;
        document.getElementById('edit_description').value = project.description;
        document.getElementById('edit_date').value = project.date;
        document.getElementById('edit_type').value = project.type;
        
        openModal('editModal');
    }
</script>
@endsection
