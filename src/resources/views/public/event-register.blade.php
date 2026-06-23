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

                {{-- Encabezado formato institucional (mismo diseno que drawTopInstitutionalHeader) --}}
                <div class="bg-white px-4 pt-4 sm:px-6">
                    <div class="w-full border border-black bg-white font-sans text-[9px] leading-tight"
                         style="display:grid; grid-template-columns: 35fr 201fr 45fr;">

                        {{-- Logo --}}
                        <div class="border-r border-black flex items-center justify-center p-1.5 min-h-[60px]">
                            <img src="{{ asset('images/logo_mw.png') }}" alt="Mister Wings"
                                 onerror="this.onerror=null;this.parentElement.innerHTML='<span class=\'font-bold text-xs\'>Mister Wings</span>';"
                                 class="max-h-12 w-auto">
                        </div>

                        {{-- Titulo central --}}
                        <div class="border-r border-black flex flex-col min-h-[60px]">
                            <div class="flex-1 flex items-center justify-center font-bold text-lg sm:text-xl tracking-wide"
                                 style="font-family:Impact,'Arial Black',sans-serif;">
                                FORMATO
                            </div>
                            <div class="border-t border-black flex-1 flex items-center justify-center font-bold text-lg sm:text-xl tracking-wide"
                                 style="font-family:Impact,'Arial Black',sans-serif;">
                                REGISTRO DE ASISTENCIA VIRTUAL
                            </div>
                        </div>

                        {{-- Metadatos (Código, Versión, Fecha) --}}
                        <div class="flex flex-col min-h-[60px]">
                            <div class="flex-1 px-1.5 py-0.5 leading-tight flex flex-col justify-center">
                                <div class="flex items-baseline gap-0.5">
                                    <span class="font-bold text-[8.5px]">Código:</span>
                                    <span class="text-[8.5px]">FO-SST-29</span>
                                </div>
                                <div class="flex items-baseline gap-0.5">
                                    <span class="font-bold text-[8.5px]">Versión:</span>
                                    <span class="text-[8.5px]">01</span>
                                </div>
                            </div>
                            <div class="border-t border-black flex-1 px-1.5 py-0.5 leading-tight flex flex-col justify-center">
                                <div class="font-bold text-[8.5px]">Fecha de edición:</div>
                                <div class="text-[8.5px]">22-Jun-2026</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informacion del evento (mismo diseno que drawEventMainInformation) --}}
                @php
                    $reason = $event->reason ?? '';
                    $reasonNorm = str_replace(
                        ['Á','É','Í','Ó','Ú','Ü','Ñ','á','é','í','ó','ú','ü','ñ'],
                        ['A','E','I','O','U','U','N','A','E','I','O','U','U','N'],
                        Str::upper($reason)
                    );
                    $isInduccion   = $reason !== '' && str_contains($reasonNorm, 'INDUCCION CORPORATIVA');
                    $isReinduccion = $reason !== '' && str_contains($reasonNorm, 'REINDUCCION');
                    $isCapacitacion = $reason !== '' && str_contains($reasonNorm, 'CAPACITACION');
                    $isDivulgacion = $reason !== '' && str_contains($reasonNorm, 'DIVULGACION DE INFORMACION');
                @endphp
                <div class="bg-white px-4 pb-4 sm:px-6">
                    <div class="w-full border-x border-b border-black bg-white font-sans text-black divide-y divide-black text-[9px]">

                        {{-- Row 1: FECHA | TEMA | HORA INICIO | HORA FINAL --}}
                        <div class="flex flex-col sm:flex-row">
                            <div class="flex items-baseline px-2 py-1.5 sm:border-r sm:border-black sm:w-[14%]">
                                <span class="font-bold shrink-0">FECHA:</span>
                                <span class="ml-1 flex-1 min-w-[50px]">{{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-baseline px-2 py-1.5 sm:border-r sm:border-black flex-1">
                                <span class="font-bold shrink-0">TEMA:</span>
                                <span class="ml-1 flex-1 min-w-[60px]">{{ $event->topic }}</span>
                            </div>
                            <div class="flex items-baseline px-2 py-1.5 sm:border-r sm:border-black sm:w-[18%]">
                                <span class="font-bold shrink-0">HORA INICIO:</span>
                                <span class="ml-1 flex-1 min-w-[40px]">{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}</span>
                            </div>
                            <div class="flex items-baseline px-2 py-1.5 sm:w-[18%]">
                                <span class="font-bold shrink-0">HORA FINAL:</span>
                                <span class="ml-1 flex-1 min-w-[40px]">{{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</span>
                            </div>
                        </div>

                        {{-- Row 2: DIRIGE | CARGO/ÁREA | LUGAR --}}
                        <div class="flex flex-col sm:flex-row">
                            <div class="flex items-baseline px-2 py-1.5 sm:border-r sm:border-black flex-1">
                                <span class="font-bold shrink-0">DIRIGE:</span>
                                <span class="ml-1 flex-1 min-w-[60px]">{{ $event->directedBy?->name ?? '' }}</span>
                            </div>
                            <div class="flex items-baseline px-2 py-1.5 sm:border-r sm:border-black flex-1">
                                <span class="font-bold shrink-0">CARGO/ÁREA:</span>
                                <span class="ml-1 flex-1 min-w-[50px]">{{ $event->directed_by_position ?? '' }}</span>
                            </div>
                            <div class="flex items-baseline px-2 py-1.5 flex-1">
                                <span class="font-bold shrink-0">LUGAR:</span>
                                <span class="ml-1 flex-1 min-w-[50px]">{{ $event->place ?? '' }}</span>
                            </div>
                        </div>

                        {{-- Row 3: MOTIVO DE LA REUNIÓN + opciones --}}
                        <div class="flex flex-wrap items-baseline gap-x-0.5 gap-y-0.5 px-2 py-1.5">
                            <span class="font-bold">MOTIVO DE LA REUNIÓN:</span>
                            <span class="font-bold ml-1">INDUCCIÓN CORPORATIVA</span>
                            <span class="min-w-[16px] text-center font-bold">{{ $isInduccion ? 'X' : '' }}</span>
                            <span class="font-bold ml-1">REINDUCCIÓN</span>
                            <span class="min-w-[16px] text-center font-bold">{{ $isReinduccion ? 'X' : '' }}</span>
                            <span class="font-bold ml-1">CAPACITACIÓN</span>
                            <span class="min-w-[16px] text-center font-bold">{{ $isCapacitacion ? 'X' : '' }}</span>
                            <span class="font-bold ml-1">DIVULGACIÓN DE INFORMACIÓN</span>
                            <span class="min-w-[16px] text-center font-bold flex-1">{{ $isDivulgacion ? 'X' : '' }}</span>
                        </div>

                        {{-- Row 4: OTRO --}}
                        <div class="flex items-baseline px-2 py-1.5">
                            <span class="font-bold shrink-0">OTRO:</span>
                            <span class="ml-1 flex-1 min-w-[80px]">{{ $reason }}</span>
                        </div>
                    </div>

                    @if ($attachmentUrl && $isViewable)
                        <div class="mt-2 pt-2 border-t border-warm-200">
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
