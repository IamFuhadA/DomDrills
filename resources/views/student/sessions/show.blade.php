<x-layouts.student>
    <x-slot name="title">{{ $session->title }} — Recording</x-slot>
    <x-slot name="pageTitle">Live Session Recording</x-slot>

    {{-- Breadcrumb --}}
    <div class="mb-6">
        <a href="{{ route('student.sessions.index') }}" class="inline-flex items-center gap-2 text-xs text-charcoal-muted hover:text-brand transition-colors duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
            Back to sessions list
        </a>
    </div>

    <div class="max-w-4xl space-y-6">
        
        {{-- Secure Video Player Container --}}
        <div class="relative rounded-2xl overflow-hidden bg-black aspect-video shadow-lg border border-charcoal/10" oncontextmenu="return false;">
            
            {{-- Anti-Piracy Watermark --}}
            <div class="absolute inset-0 pointer-events-none z-10 select-none overflow-hidden" id="video-watermark-container">
                <div id="video-watermark" class="absolute text-[11px] font-bold text-white/10 uppercase tracking-widest px-3 py-1 bg-black/20 rounded backdrop-blur-[1px] transition-all duration-1000 ease-in-out" style="top: 15%; left: 15%;">
                    {{ auth()->user()->name }} ({{ auth()->user()->email }})
                </div>
            </div>

            {{-- HTML5 Video --}}
            <video
                id="secure-player"
                class="w-full h-full object-contain"
                controls
                controlsList="nodownload"
                disablePictureInPicture
                playsinline
            >
                <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        {{-- Session Details --}}
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between gap-3 mb-4 pb-4 border-b border-border">
                    <div>
                        <span class="text-charcoal-muted text-xs">Live Stream Recap</span>
                        <h1 class="font-heading font-bold text-xl lg:text-2xl text-charcoal mt-1">{{ $session->title }}</h1>
                    </div>
                    <div class="text-right text-xs text-charcoal-muted">
                        <p class="font-semibold text-charcoal">Recorded On</p>
                        <p>{{ $session->scheduled_at->format('d M Y') }}</p>
                    </div>
                </div>

                <div class="prose-dd">
                    <h3 class="font-heading font-bold text-charcoal text-base mb-2">Session Notes & Summary</h3>
                    <p class="text-charcoal-muted text-sm leading-relaxed mb-6">{{ $session->description }}</p>
                    
                    <div class="bg-ivory-alt/50 border border-border rounded-xl p-5 text-charcoal-muted text-xs space-y-2.5">
                        <p class="font-heading font-semibold text-charcoal text-sm mb-1.5">Topics Covered:</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Real-time auction order matching flow.</li>
                            <li>Accumulation ranges vs distribution ranges node review.</li>
                            <li>Understanding buyer absorption profiles on dynamic levels.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
    (function() {
        const player = document.getElementById('secure-player');
        if (player) {
            player.disablePictureInPicture = true;
            
            const watermark = document.getElementById('video-watermark');
            if (watermark) {
                setInterval(() => {
                    const top = Math.floor(Math.random() * 80) + 10;
                    const left = Math.floor(Math.random() * 70) + 10;
                    watermark.style.top = top + '%';
                    watermark.style.left = left + '%';
                }, 8000);
            }
        }
    })();
    </script>
    @endpush
</x-layouts.student>
