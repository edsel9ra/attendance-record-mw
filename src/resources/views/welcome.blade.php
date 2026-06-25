<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sistema de Asistencia') }}</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="ambient-shell min-h-screen font-sans text-navy-900 antialiased">
    <a href="#contenido-principal" class="skip-link">Saltar al contenido principal</a>

    <div class="relative z-10 flex min-h-screen flex-col">
        <header class="reveal px-4 pt-4 sm:px-6" style="--reveal-delay: 60ms;">
            <div class="mx-auto flex max-w-6xl items-center justify-between rounded-2xl border border-warm-200/80 bg-white/65 px-4 py-3 shadow-sm shadow-navy-900/5 backdrop-blur-md sm:px-5">
                <a href="{{ url('/') }}" class="flex items-center gap-3" aria-label="Inicio">
                    <span class="grid h-10 w-10 place-items-center rounded-xl bg-navy-900 text-sm font-bold text-white shadow-lg shadow-navy-900/15">AR</span>
                    <span>
                        <span class="block font-serif text-xl leading-none text-navy-900">Asistencia</span>
                        <span class="block text-[11px] font-medium uppercase tracking-[0.24em] text-warm-600">Registro digital</span>
                    </span>
                </a>

                @php $loginRoute = 'filament.admin.auth.login'; @endphp
                @if (Route::has($loginRoute))
                    <nav class="flex items-center gap-3" aria-label="Navegación principal">
                        @auth
                            <a href="{{ url('/admin') }}" class="nav-pill group">
                                Panel administrativo
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        @else
                            <a href="{{ route($loginRoute) }}" class="nav-pill group">
                                Ingresar
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main id="contenido-principal" tabindex="-1" class="flex flex-1 items-center px-4 py-12 sm:px-6 lg:py-16">
            <section class="mx-auto grid w-full max-w-6xl items-center gap-8 lg:grid-cols-[1.08fr_0.92fr]">
                <div class="reveal" style="--reveal-delay: 140ms;">
                    <span class="mb-5 inline-flex items-center gap-2 rounded-full border border-gold-400/35 bg-gold-300/20 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em] text-navy-700">
                        <span class="h-2 w-2 rounded-full bg-red-500 shadow-[0_0_0_5px_rgba(239,68,68,0.12)]" aria-hidden="true"></span>
                        Gestión de eventos
                    </span>

                    <h1 class="max-w-3xl font-serif text-5xl leading-[0.96] tracking-tight text-navy-900 sm:text-6xl lg:text-7xl">
                        Asistencia clara,
                        <span class="text-red-600">firmas seguras</span>
                        y reportes listos.
                    </h1>

                    <p class="mt-6 max-w-2xl text-lg leading-8 text-warm-700 sm:text-xl">
                        Administre el registro de asistencia de sus eventos con códigos QR, firmas digitales y exportes pensados para seguimiento institucional.
                    </p>

                    <div class="mt-9 flex flex-wrap items-center gap-3">
                        @auth
                            <a href="{{ url('/admin') }}" class="primary-cta px-7 py-4 text-sm">
                                Ir al panel
                                <svg class="relative h-4 w-4" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        @else
                            <a href="{{ route($loginRoute) }}" class="primary-cta px-7 py-4 text-sm">
                                Acceder al sistema
                                <svg class="relative h-4 w-4" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </a>
                        @endauth
                        <span class="rounded-full border border-warm-200 bg-white/55 px-4 py-3 text-sm font-medium text-warm-700 shadow-sm shadow-navy-900/5">
                            Flujo QR + firma + reporte
                        </span>
                    </div>
                </div>

                <div class="reveal relative" style="--reveal-delay: 260ms;" aria-hidden="true">
                    <div class="surface-card relative overflow-hidden rounded-[2rem] p-5 sm:p-6">
                        <div class="absolute -right-16 -top-16 h-44 w-44 rounded-full bg-red-500/10 blur-2xl"></div>
                        <div class="relative rounded-3xl bg-navy-900 p-6 text-white shadow-2xl shadow-navy-900/20">
                            <div class="mb-8 flex items-center justify-between">
                                <span class="text-xs font-bold uppercase tracking-[0.24em] text-gold-300">Evento activo</span>
                                <span class="rounded-full bg-white/10 px-3 py-1 text-xs text-white/80">QR público</span>
                            </div>
                            <div class="space-y-4">
                                <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                                    <span class="text-sm text-white/60">Registro</span>
                                    <p class="mt-1 text-2xl font-semibold">Asistencia virtual</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="rounded-2xl bg-white p-4 text-navy-900 shadow-lg shadow-black/10">
                                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-warm-500">Firma</span>
                                        <p class="mt-3 h-10 rounded-lg border-b-2 border-navy-900/70 font-serif text-xl italic text-navy-700">Lista</p>
                                    </div>
                                    <div class="rounded-2xl border border-gold-300/35 bg-gold-300/15 p-4">
                                        <span class="text-xs font-semibold uppercase tracking-[0.18em] text-gold-300">Reporte</span>
                                        <p class="mt-3 text-3xl font-bold">PDF</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="relative mt-4 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-2xl border border-warm-200 bg-white/80 p-4">
                                <span class="block text-2xl font-bold text-navy-900">01</span>
                                <span class="text-xs font-medium text-warm-600">Crear evento</span>
                            </div>
                            <div class="rounded-2xl border border-warm-200 bg-white/80 p-4">
                                <span class="block text-2xl font-bold text-navy-900">02</span>
                                <span class="text-xs font-medium text-warm-600">Compartir QR</span>
                            </div>
                            <div class="rounded-2xl border border-warm-200 bg-white/80 p-4">
                                <span class="block text-2xl font-bold text-navy-900">03</span>
                                <span class="text-xs font-medium text-warm-600">Exportar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="relative z-10 px-6 py-6 text-center text-xs font-medium uppercase tracking-[0.24em] text-warm-600">
            {{ config('app.name', 'Sistema de Asistencia') }} &middot; {{ date('Y') }}
        </footer>
    </div>
</body>
</html>
