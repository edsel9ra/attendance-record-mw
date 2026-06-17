<x-filament::page>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 transition-shadow hover:shadow-md">
            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Detalles del Evento
            </h2>
            <dl class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500">Fecha</dt>
                    <dd class="font-medium">{{ \Carbon\Carbon::parse($this->record->date)->format('d/m/Y') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Tema</dt>
                    <dd class="font-medium">{{ $this->record->topic }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Hora inicio</dt>
                    <dd class="font-medium">{{ \Carbon\Carbon::parse($this->record->start_time)->format('H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Hora fin</dt>
                    <dd class="font-medium">{{ \Carbon\Carbon::parse($this->record->end_time)->format('H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Lugar</dt>
                    <dd class="font-medium">{{ $this->record->place }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500">Dirige</dt>
                    <dd class="font-medium">{{ $this->record->directedBy->name }} - {{ $this->record->directed_by_position }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-gray-500">Motivo</dt>
                    <dd class="font-medium">{{ $this->record->reason }}</dd>
                </div>
                <div class="col-span-2 flex items-center gap-2 pt-2 border-t border-gray-100">
                    <dt class="text-gray-500 text-sm">Asistencias registradas:</dt>
                    <dd class="font-semibold text-gray-900 text-lg">{{ $this->record->attendances()->count() }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-shadow hover:shadow-md">
            <div class="bg-gradient-to-br from-red-50 to-orange-50 p-6 sm:p-8 flex flex-col items-center text-center">
                <h2 class="text-lg font-semibold text-gray-900 mb-1">Código QR</h2>
                <p class="text-sm text-gray-500 mb-6">Comparte este código para que los asistentes registren su asistencia.</p>
                <div class="bg-white p-4 rounded-xl shadow-md shadow-red-900/5 border border-red-100 inline-block transition-transform hover:scale-105 duration-300">
                    {!! $this->getQrCodeSvg() !!}
                </div>
                <div class="mt-5 w-full max-w-md">
                    <div class="flex items-center gap-2 bg-white rounded-lg border border-gray-200 px-4 py-2.5 text-sm transition-all hover:border-red-200 hover:shadow-sm">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        <a href="{{ $this->getPublicUrl() }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline truncate">
                            {{ $this->getPublicUrl() }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
