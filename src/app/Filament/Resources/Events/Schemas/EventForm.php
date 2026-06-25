<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Position;
use App\Models\Reason;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                DatePicker::make('date')
                    ->label('Fecha')
                    ->required(),
                TextInput::make('topic')
                    ->label('Tema')
                    ->required()
                    ->columnSpanFull(),
                TimePicker::make('start_time')
                    ->label('Hora de inicio')
                    ->required(),
                TimePicker::make('end_time')
                    ->label('Hora final')
                    ->required(),
                TextInput::make('place')
                    ->label('Lugar')
                    ->required(),
                Select::make('reason')
                    ->label('Motivo')
                    ->required()
                    ->columnSpanFull()
                    ->options(fn () => Reason::where('is_active', true)->pluck('name', 'name'))
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(40)
                    ->placeholder('Seleccionar motivo')
                    ->searchPrompt('Escriba para buscar un motivo')
                    ->noSearchResultsMessage('No se encontraron motivos con ese texto.')
                    ->loadingMessage('Cargando motivos...')
                    ->helperText('Si el motivo no está en la lista, use el botón + para ingresar uno personalizado.')
                    ->createOptionModalHeading('Agregar motivo personalizado')
                    ->createOptionForm(self::customOptionForm('Motivo personalizado', 'Ejemplo: Reunión extraordinaria'))
                    ->createOptionUsing(fn (array $data): string => trim($data['name']))
                    ->createOptionAction(fn (Action $action) => $action
                        ->label('Agregar motivo personalizado')
                        ->tooltip('Agregar motivo personalizado')
                        ->modalSubmitActionLabel('Usar motivo')),
                Hidden::make('directed_by_id')
                    ->default(fn () => auth()->id()),
                Select::make('directed_by_position')
                    ->label('Cargo de quien dirige')
                    ->required()
                    ->options(fn () => Position::where('is_active', true)->pluck('name', 'name'))
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->optionsLimit(40)
                    ->placeholder('Seleccionar cargo')
                    ->searchPrompt('Escriba para buscar un cargo')
                    ->noSearchResultsMessage('No se encontraron cargos con ese texto.')
                    ->loadingMessage('Cargando cargos...')
                    ->helperText('Si el cargo no está en la lista, use el botón + para ingresar uno personalizado.')
                    ->createOptionModalHeading('Agregar cargo personalizado')
                    ->createOptionForm(self::customOptionForm('Cargo personalizado', 'Ejemplo: Coordinador SST'))
                    ->createOptionUsing(fn (array $data): string => trim($data['name']))
                    ->createOptionAction(fn (Action $action) => $action
                        ->label('Agregar cargo personalizado')
                        ->tooltip('Agregar cargo personalizado')
                        ->modalSubmitActionLabel('Usar cargo')),
                FileUpload::make('attachment_path')
                    ->label('Archivo adjunto')
                    ->disk('public')
                    ->directory('events')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                        'image/gif',
                        'image/webp',
                    ])
                    ->maxSize(10240),
                Hidden::make('slug'),
            ]);
    }

    private static function customOptionForm(string $label, string $placeholder): array
    {
        return [
            TextInput::make('name')
                ->label($label)
                ->placeholder($placeholder)
                ->required()
                ->maxLength(255)
                ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? trim($state) : null),
        ];
    }
}
