<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia — {{ $event->topic }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-warm-100 font-sans antialiased" style="background-image:
    radial-gradient(ellipse at 20% 0%, rgba(15,31,54,0.06) 0%, transparent 60%),
    radial-gradient(ellipse at 80% 100%, rgba(239,68,68,0.06) 0%, transparent 50%),
    repeating-linear-gradient(45deg, transparent, transparent 40px, rgba(0,0,0,0.015) 40px, rgba(0,0,0,0.015) 41px);">

    <div class="min-h-screen flex items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
        <div class="w-full max-w-5xl animate-[fadeIn_0.6s_ease-out] opacity-0" style="animation-fill-mode: forwards;">
            <div class="bg-warm-50 rounded-2xl shadow-xl shadow-navy-900/5 border border-warm-200 overflow-hidden">

                {{-- Encabezado formato institucional --}}
                <div class="bg-white px-4 pt-4 sm:px-6">
                    <img src="{{ asset('images/header-registro-asistencia.png') }}" alt="Formato Registro de Asistencia"
                        class="w-full h-auto border border-black bg-white">
                </div>

                {{-- Tema del evento --}}
                <div class="px-8 sm:px-10 py-5 bg-white border-b border-warm-200">
                    <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Tema / Capacitación</span>
                    <h1 class="mt-1 text-xl sm:text-2xl font-bold text-navy-800 leading-tight">{{ $event->topic }}</h1>
                </div>

                {{-- Event Details --}}
                <div class="px-8 sm:px-10 pt-8 pb-4 border-b border-warm-200">
                    <div class="grid grid-cols-2 gap-x-8 gap-y-4 text-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Fecha</span>
                                <p class="text-navy-800 font-medium">
                                    {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Horario</span>
                                <p class="text-navy-800 font-medium">
                                    {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} —
                                    {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Lugar</span>
                                <p class="text-navy-800 font-medium">{{ $event->place }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div>
                                <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Dirige</span>
                                <p class="text-navy-800 font-medium">{{ $event->directedBy->name }} —
                                    {{ $event->directed_by_position }}</p>
                            </div>
                        </div>
                        <div class="col-span-2 flex items-start gap-3">
                            <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <span class="text-warm-500 text-xs uppercase tracking-wider font-medium">Motivo</span>
                                <p class="text-navy-800 font-medium">{{ $event->reason }}</p>
                            </div>
                        </div>
                    </div>

                    @if ($attachmentUrl && $isViewable)
                        <div class="mt-4 pt-4 border-t border-warm-200">
                            <a href="{{ $attachmentUrl }}" target="_blank"
                                class="inline-flex items-center gap-2 text-sm font-medium text-navy-600 hover:text-navy-800 transition-colors group">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span
                                    class="underline underline-offset-2 decoration-warm-300 group-hover:decoration-navy-500 transition-all">Ver
                                    archivo adjunto</span>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Form --}}
                <div class="px-8 sm:px-10 py-8">
                    @if (session('success'))
                        <div
                            class="mb-6 bg-emerald-50 border border-emerald-200/70 text-emerald-800 px-5 py-4 rounded-xl text-sm flex items-start gap-3 animate-[fadeIn_0.4s_ease-out]">
                            <svg class="w-5 h-5 text-emerald-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div
                            class="mb-6 bg-red-50 border border-red-200/70 text-red-800 px-5 py-4 rounded-xl text-sm flex items-start gap-3 animate-[fadeIn_0.4s_ease-out]">
                            <svg class="w-5 h-5 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('event.register', $event->slug) }}" id="attendanceForm"
                        class="space-y-6">
                        @csrf

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div class="sm:col-span-2">
                                <label for="full_name" class="block text-sm font-medium text-navy-800 mb-1.5">Nombre
                                    Completo</label>
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
                                    required
                                    class="w-full rounded-xl border border-warm-300 bg-white px-4 py-3 text-navy-900 text-sm placeholder:text-warm-400 transition-all duration-200 focus:ring-2 focus:ring-red-400/30 focus:border-red-500 focus:outline-none hover:border-warm-400 hover:shadow-sm">
                            </div>

                            <div>
                                <label for="id_number" class="block text-sm font-medium text-navy-800 mb-1.5">Número de
                                    Identificación</label>
                                <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}"
                                    required
                                    class="w-full rounded-xl border border-warm-300 bg-white px-4 py-3 text-navy-900 text-sm placeholder:text-warm-400 transition-all duration-200 focus:ring-2 focus:ring-red-400/30 focus:border-red-500 focus:outline-none hover:border-warm-400 hover:shadow-sm">
                            </div>

                            <div>
                                <label for="position_id"
                                    class="block text-sm font-medium text-navy-800 mb-1.5">Cargo</label>
                                <select name="position_id" id="position_id"
                                    class="w-full rounded-xl border border-warm-300 bg-white px-4 py-3 text-navy-900 text-sm transition-all duration-200 focus:ring-2 focus:ring-red-400/30 focus:border-red-500 focus:outline-none hover:border-warm-400 hover:shadow-sm">
                                    <option value="" class="text-warm-400">Seleccionar cargo</option>
                                    @foreach ($positions as $position)
                                        <option value="{{ $position->id }}" {{ old('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="headquarter_id"
                                    class="block text-sm font-medium text-navy-800 mb-1.5">Sede</label>
                                <select name="headquarter_id" id="headquarter_id"
                                    class="w-full rounded-xl border border-warm-300 bg-white px-4 py-3 text-navy-900 text-sm transition-all duration-200 focus:ring-2 focus:ring-red-400/30 focus:border-red-500 focus:outline-none hover:border-warm-400 hover:shadow-sm">
                                    <option value="" class="text-warm-400">Seleccionar sede</option>
                                    @foreach ($headquarters as $headquarter)
                                        <option value="{{ $headquarter->id }}" {{ old('headquarter_id') == $headquarter->id ? 'selected' : '' }}>{{ $headquarter->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Signature --}}
                        <div>
                            <label class="block text-sm font-medium text-navy-800 mb-1.5">Firma</label>
                            <div
                                class="relative rounded-xl border-2 border-dashed border-warm-300 bg-white overflow-hidden transition-all duration-200 hover:border-warm-400 focus-within:border-red-500 focus-within:ring-2 focus-within:ring-red-400/20 hover:shadow-sm">
                                <canvas id="signatureCanvas" class="w-full h-40 cursor-crosshair touch-none"></canvas>
                                <div id="signaturePlaceholder"
                                    class="absolute inset-0 flex items-center justify-center pointer-events-none select-none transition-opacity duration-300">
                                    <span class="text-warm-400 text-sm">Dibuja tu firma aquí</span>
                                </div>
                            </div>
                            <input type="hidden" name="signature" id="signatureInput">
                            <div class="flex items-center justify-between mt-3">
                                <button type="button" id="clearSignature"
                                    class="inline-flex items-center gap-1.5 text-sm text-warm-600 hover:text-red-600 transition-all duration-200 font-medium hover:scale-[1.02] active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Limpiar firma
                                </button>
                                <span id="signatureStatus" class="text-xs text-warm-400"></span>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn"
                            class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white py-3.5 px-6 rounded-xl font-medium text-sm tracking-wide transition-all duration-200 hover:from-red-500 hover:to-red-600 hover:shadow-lg hover:shadow-red-600/20 active:scale-[0.97] disabled:opacity-50 disabled:cursor-not-allowed disabled:active:scale-100 shadow-md shadow-red-600/10">
                            Registrar Asistencia
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-xs text-warm-500 mt-6 tracking-wide">Sistema de Registro de Asistencia</p>
        </div>
    </div>

</body>

</html>
