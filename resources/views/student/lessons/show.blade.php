<x-layouts.student>
    <x-slot name="title">{{ $lesson->title }} — {{ $course->title }}</x-slot>
    <x-slot name="pageTitle">Learning Portal</x-slot>

    <div class="flex flex-col xl:flex-row gap-6 items-start">
        
        {{-- =====================================================
             Left Column: Video Player & Details
             ===================================================== --}}
        <div class="flex-1 w-full space-y-6">
            
            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-xs text-charcoal-muted">
                <a href="{{ route('student.courses.index') }}" class="hover:text-brand transition-colors">Courses</a>
                <span>/</span>
                <a href="{{ route('student.courses.show', $course->slug) }}" class="hover:text-brand transition-colors truncate max-w-[150px]">{{ $course->title }}</a>
                <span>/</span>
                <span class="text-charcoal truncate max-w-[150px]">{{ $lesson->title }}</span>
            </div>

            {{-- Secure Video Player Container --}}
            <div id="secure-video-shell" class="relative rounded-2xl overflow-hidden bg-charcoal aspect-video shadow-lg border border-charcoal/10 select-none" oncontextmenu="return false;">
                
                {{-- Anti-Piracy Watermark --}}
                <div class="absolute inset-0 pointer-events-none z-10 select-none overflow-hidden" id="video-watermark-container">
                    <div id="video-watermark" class="absolute text-[11px] font-bold text-white/10 uppercase tracking-widest px-3 py-1 bg-charcoal/20 rounded backdrop-blur-[1px] transition-all duration-1000 ease-in-out" style="top: 10%; left: 10%;">
                        {{ auth()->user()->name }} / {{ auth()->user()->email }} / {{ now()->format('d M Y H:i') }}
                    </div>
                </div>

                {{-- HTML5 Video --}}
                @if($videoUrl)
                    <video
                        id="secure-player"
                        class="w-full h-full object-contain"
                        controls
                        controlsList="nodownload noplaybackrate noremoteplayback"
                        disablePictureInPicture
                        disableRemotePlayback
                        playsinline
                        preload="metadata"
                    >
                        <source src="{{ $videoUrl }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <div class="absolute inset-0 flex items-center justify-center p-6 text-center">
                        <p class="text-sm text-white/70">This lesson video is not available yet.</p>
                    </div>
                @endif
            </div>

            {{-- Lesson Info & Complete Button --}}
            <div class="card">
                <div class="card-body">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-6 border-b border-border">
                        <div>
                            <span class="text-brand text-2xs font-semibold uppercase tracking-wide">Module {{ $lesson->module->order }} • Lesson {{ $lesson->order }}</span>
                            <h1 class="font-heading font-bold text-xl lg:text-2xl text-charcoal mt-1">{{ $lesson->title }}</h1>
                        </div>
                        <div x-data="{ completed: {{ $lesson->isCompletedBy(auth()->user()) ? 'true' : 'false' }} }">
                            <button
                                @click="
                                    fetch('{{ route('student.lessons.progress', $lesson->slug) }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        if(data.status === 'success') {
                                            completed = true;
                                        }
                                    })
                                "
                                :class="completed ? 'bg-state-success/10 text-state-success border-state-success/20 cursor-default' : 'btn-primary'"
                                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border text-sm font-semibold transition-all duration-200"
                                :disabled="completed"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span x-text="completed ? 'Completed' : 'Mark as Complete'">Mark as Complete</span>
                            </button>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="prose-dd">
                        <h3 class="font-heading font-bold text-charcoal text-base mb-3">Lesson Overview</h3>
                        <p class="text-charcoal-muted text-sm leading-relaxed mb-6">{{ $lesson->description }}</p>
                        
                        @if($lesson->content)
                            <h3 class="font-heading font-bold text-charcoal text-base mb-3">Syllabus & Notes</h3>
                            <div class="bg-ivory-alt/50 border border-border rounded-xl p-5 text-charcoal-muted text-sm leading-relaxed whitespace-pre-line">
                                {{ $lesson->content }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- =====================================================
             Right Column: Curriculum Sidebar Navigation
             ===================================================== --}}
        <div class="w-full xl:w-80 flex-shrink-0 space-y-4">
            <div class="card">
                <div class="px-5 py-4.5 border-b border-border">
                    <h3 class="font-heading font-semibold text-charcoal text-sm">Course Syllabus</h3>
                    <p class="text-charcoal-muted text-2xs truncate">{{ $course->title }}</p>
                </div>
                <div class="divide-y divide-border overflow-y-auto max-h-[600px]">
                    @foreach($modules as $mIndex => $mod)
                    <div x-data="{ expanded: {{ $mod->id === $lesson->module_id ? 'true' : 'false' }} }">
                        <div class="px-5 py-3.5 bg-ivory-alt/20 flex items-center justify-between cursor-pointer hover:bg-ivory transition-colors" @click="expanded = !expanded">
                            <div class="min-w-0">
                                <p class="text-brand text-[10px] font-semibold uppercase tracking-wider">Module {{ $mIndex + 1 }}</p>
                                <p class="font-heading font-medium text-charcoal text-xs truncate">{{ $mod->title }}</p>
                            </div>
                            <svg class="w-4 h-4 text-charcoal-muted transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                        
                        <div x-show="expanded" class="bg-white divide-y divide-border/40">
                            @foreach($mod->lessons as $l)
                            <a href="{{ route('student.lessons.show', $l->slug) }}"
                               class="flex items-start gap-2.5 px-5 py-3 text-xs transition-colors duration-200
                                      {{ $l->id === $lesson->id ? 'bg-brand/5 text-brand font-semibold' : 'text-charcoal-muted hover:bg-ivory hover:text-charcoal' }}">
                                <div class="mt-0.5 flex-shrink-0">
                                    @if($l->isCompletedBy(auth()->user()))
                                        <svg class="w-4 h-4 text-state-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @else
                                        <div class="w-4 h-4 rounded-full border border-border flex items-center justify-center font-bold text-[9px]">
                                            {{ $l->order }}
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="truncate">{{ $l->title }}</p>
                                    <p class="text-charcoal-muted/60 text-[10px] mt-0.5">{{ $l->duration_minutes }} mins</p>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
    (function() {
        const shell = document.getElementById('secure-video-shell');
        const player = document.getElementById('secure-player');

        const blockEvent = (event) => {
            event.preventDefault();
            event.stopPropagation();
            return false;
        };

        if (shell) {
            ['contextmenu', 'dragstart', 'selectstart'].forEach((eventName) => {
                shell.addEventListener(eventName, blockEvent);
            });
        }

        document.addEventListener('keydown', (event) => {
            const key = event.key.toLowerCase();
            const blockedCombo = (event.ctrlKey || event.metaKey) && ['s', 'u', 'p'].includes(key);

            if (blockedCombo || key === 'f12' || key === 'printscreen') {
                blockEvent(event);
                if (key === 'printscreen' && navigator.clipboard) {
                    navigator.clipboard.writeText('');
                }
            }
        });

        if (player) {
            player.disablePictureInPicture = true;
            player.disableRemotePlayback = true;
            player.setAttribute('controlsList', 'nodownload noplaybackrate noremoteplayback');
            
            const watermark = document.getElementById('video-watermark');
            if (watermark) {
                setInterval(() => {
                    const top = Math.floor(Math.random() * 72) + 8;
                    const left = Math.floor(Math.random() * 62) + 8;
                    watermark.style.top = top + '%';
                    watermark.style.left = left + '%';
                    watermark.style.opacity = (Math.random() * 0.08 + 0.08).toFixed(2);
                }, 6000);
            }
        }
    })();
    </script>
    @endpush
</x-layouts.student>
