<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Authentication' }} — DomDrills</title>
    <meta name="robots" content="noindex, nofollow">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body bg-ivory text-charcoal antialiased min-h-screen">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        {{-- Left Panel: Brand side --}}
        <div class="hidden lg:flex flex-col justify-between relative overflow-hidden bg-charcoal p-12">

            {{-- Background canvas --}}
            <canvas id="auth-canvas" class="absolute inset-0 w-full h-full opacity-40" aria-hidden="true"></canvas>

            {{-- Brand overlay gradient --}}
            <div class="absolute inset-0 bg-gradient-to-br from-charcoal via-charcoal to-brand/30 pointer-events-none" aria-hidden="true"></div>

            {{-- Top: Logo --}}
            <div class="relative z-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-9 h-9 rounded-xl bg-gradient-brand flex items-center justify-center shadow-brand">
                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <span class="font-heading font-bold text-xl text-white tracking-tight">Dom<span class="text-brand">Drills</span></span>
                </a>
            </div>

            {{-- Center: Philosophy --}}
            <div class="relative z-10">
                <blockquote class="mb-8">
                    <p class="font-heading font-bold text-white text-3xl lg:text-4xl leading-tight mb-6" style="letter-spacing:-0.02em">
                        "We don't teach people how to gamble.<br>
                        We teach people how <span class="text-brand">professionals understand markets</span>."
                    </p>
                </blockquote>

                {{-- Concept pills --}}
                <div class="flex flex-wrap gap-2">
                    @foreach(['Order Flow','Footprint','Volume Profile','Options','Gamma','Liquidity','Market Profile','Delta'] as $c)
                        <span class="px-3 py-1 rounded-full bg-white/8 border border-white/12 text-white/60 text-xs font-body">{{ $c }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Bottom: Trust signals --}}
            <div class="relative z-10 flex items-center gap-6 pt-8 border-t border-white/10">
                <div class="text-center">
                    <p class="font-heading font-bold text-white text-xl">8+</p>
                    <p class="text-white/40 text-xs font-body">Core Concepts</p>
                </div>
                <div class="w-px h-8 bg-white/15"></div>
                <div class="text-center">
                    <p class="font-heading font-bold text-white text-xl">Live</p>
                    <p class="text-white/40 text-xs font-body">Sessions</p>
                </div>
                <div class="w-px h-8 bg-white/15"></div>
                <div class="text-center">
                    <p class="font-heading font-bold text-white text-xl">EN|ML</p>
                    <p class="text-white/40 text-xs font-body">Bilingual</p>
                </div>
            </div>
        </div>

        {{-- Right Panel: Auth form --}}
        <div class="flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-16 xl:px-24">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-10">
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-brand flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                        </svg>
                    </div>
                    <span class="font-heading font-bold text-lg text-charcoal tracking-tight">Dom<span class="text-brand">Drills</span></span>
                </a>
            </div>

            <div class="w-full max-w-sm mx-auto lg:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </div>

    {{-- Auth canvas animation --}}
    <script>
    (function(){
        const canvas = document.getElementById('auth-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let W, H, pts = [];

        function resize(){
            W = canvas.width = canvas.offsetWidth;
            H = canvas.height = canvas.offsetHeight;
        }

        function init(){
            pts = [];
            for(let i=0;i<40;i++){
                pts.push({
                    x:Math.random()*W, y:Math.random()*H,
                    vx:(Math.random()-.5)*.15, vy:(Math.random()-.5)*.1,
                    r: Math.random()*1.5+.5
                });
            }
        }

        function wrap(v,max){ return v<0?max:v>max?0:v; }

        function draw(){
            ctx.clearRect(0,0,W,H);
            pts.forEach(p=>{
                p.x=wrap(p.x+p.vx,W);
                p.y=wrap(p.y+p.vy,H);
                ctx.beginPath();
                ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
                ctx.fillStyle='rgba(201,106,27,0.3)';
                ctx.fill();
            });
            requestAnimationFrame(draw);
        }
        resize(); init(); draw();
        window.addEventListener('resize',()=>{ resize(); init(); });
    })();
    </script>
</body>
</html>
