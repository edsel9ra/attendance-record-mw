<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de Asistencias - {{ config('app.name') }}</title>
    @fonts
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .animate-in { animation: fadeIn 0.3s ease-out both; }
    </style>
</head>
<body class="min-h-screen bg-warm-100 font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="animate-in w-full max-w-lg">
            <div class="bg-white rounded-2xl shadow-lg shadow-warm-900/5 p-8">
                <div class="text-center mb-8">
                    <h1 class="font-serif text-2xl text-navy-900">Reporte de Asistencias</h1>
                    <p class="text-warm-500 text-sm mt-2">Seleccione el evento y formato para descargar</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('attendances.export') }}" method="GET" class="space-y-6">
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-navy-700 mb-2">Evento</label>
                        <select name="event_id" id="event_id" required
                            class="w-full px-4 py-3 rounded-xl border border-warm-200 bg-warm-50 text-navy-900 text-sm focus:ring-2 focus:ring-navy-500/20 focus:border-navy-500 transition-all">
                            <option value="">Seleccionar evento</option>
                            @foreach ($events as $event)
                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->topic }} ({{ $event->date->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-navy-700 mb-3">Formato</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative flex items-center justify-center p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-navy-800 has-[:checked]:bg-navy-50 border-warm-200 hover:border-warm-300">
                                <input type="radio" name="format" value="xlsx" {{ request('format', 'xlsx') === 'xlsx' ? 'checked' : '' }} class="sr-only peer">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto mb-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="text-sm font-medium text-navy-800">Excel</span>
                                    <span class="text-xs text-warm-500 block">.xlsx</span>
                                </div>
                            </label>
                            <label class="relative flex items-center justify-center p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-navy-800 has-[:checked]:bg-navy-50 border-warm-200 hover:border-warm-300">
                                <input type="radio" name="format" value="pdf" {{ request('format') === 'pdf' ? 'checked' : '' }} class="sr-only peer">
                                <div class="text-center">
                                    <svg class="w-8 h-8 mx-auto mb-1 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span class="text-sm font-medium text-navy-800">PDF</span>
                                    <span class="text-xs text-warm-500 block">.pdf</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-navy-800 text-white py-3.5 rounded-xl font-medium text-sm hover:bg-navy-700 transition-all shadow-lg shadow-navy-900/10 hover:shadow-xl active:scale-[0.98]">
                        Descargar Reporte
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ url('/admin/attendances') }}" class="text-sm text-warm-500 hover:text-navy-600 transition-colors">
                        &larr; Volver a Asistencias
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
