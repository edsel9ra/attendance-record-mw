<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistema de Asistencia') }}</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>...</style>
    @endif
    <style>
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes pulseGlow { 0%, 100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.3); } 50% { box-shadow: 0 0 20px 4px rgba(239,68,68,0.15); } }
        .animate-fade-in-up { animation: fadeInUp 0.7s ease-out both; }
        .animate-fade-in { animation: fadeIn 1s ease-out both; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .hero-cta { animation: pulseGlow 2.5s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen bg-warm-100 font-sans antialiased" style="background-image:
    radial-gradient(ellipse at 30% 0%, rgba(15,31,54,0.06) 0%, transparent 60%),
    radial-gradient(ellipse at 70% 100%, rgba(239,68,68,0.05) 0%, transparent 50%);">

    <div class="min-h-screen flex flex-col">
        {{-- Nav --}}
        <header class="animate-fade-in">
            <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
                <span class="text-navy-800 font-serif text-xl tracking-tight">Asistencia</span>
                @php $loginRoute = 'filament.admin.auth.login'; @endphp
                @if (Route::has($loginRoute))
                    <nav class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/admin') }}" class="text-sm font-medium text-navy-600 hover:text-navy-800 transition-colors">Panel</a>
                        @else
                            <a href="{{ route($loginRoute) }}" class="text-sm font-medium text-navy-600 hover:text-navy-800 transition-colors">Ingresar</a>
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        {{-- Hero --}}
        <main class="flex-1 flex items-center justify-center px-6 py-16">
            <div class="max-w-3xl mx-auto text-center">
                <div class="animate-fade-in-up delay-1">
                    <span class="inline-block text-red-500 text-xs font-medium uppercase tracking-[0.25em] mb-5">Sistema de Gestión</span>
                </div>
                <h1 class="animate-fade-in-up delay-2 font-serif text-4xl sm:text-5xl lg:text-6xl text-navy-900 leading-[1.1] tracking-tight">
                    Registro de<br>
                    <span class="text-red-500">Asistencia</span> a Eventos
                </h1>
                <p class="animate-fade-in-up delay-3 mt-6 text-warm-600 text-lg sm:text-xl max-w-xl mx-auto leading-relaxed">
                    Gestione el registro de asistencia de sus eventos de manera digital. Genere códigos QR, capture firmas electrónicas y exporte reportes.
                </p>
                <div class="animate-fade-in-up delay-4 mt-10 flex items-center justify-center gap-4 flex-wrap">
                    @auth
                        <a href="{{ url('/admin') }}" class="hero-cta inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-3.5 rounded-xl font-medium text-sm hover:from-red-500 hover:to-red-600 transition-all shadow-lg shadow-red-600/15 hover:shadow-xl hover:shadow-red-600/25 active:scale-[0.97]">
                            Ir al Panel
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @else
                        <a href="{{ route($loginRoute) }}" class="hero-cta inline-flex items-center gap-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-3.5 rounded-xl font-medium text-sm hover:from-red-500 hover:to-red-600 transition-all shadow-lg shadow-red-600/15 hover:shadow-xl hover:shadow-red-600/25 active:scale-[0.97]">
                            Acceder al Sistema
                            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @endauth
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="animate-fade-in px-6 py-6 text-center text-xs text-warm-500">
            {{ config('app.name', 'Sistema de Asistencia') }} &mdash; {{ date('Y') }}
        </footer>
    </div>
</body>
</html>
