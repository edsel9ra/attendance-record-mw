<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Position;
use App\Models\Reason;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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
                TextInput::make('reason')
                    ->label('Motivo')
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('Seleccione o escriba un motivo')
                    ->datalist(fn () => Reason::where('is_active', true)->orderBy('name')->pluck('name')->all())
                    ->helperText('Puede escoger una opción existente o escribir un motivo personalizado.')
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? trim($state) : null),
                Hidden::make('directed_by_id')
                    ->default(fn () => auth()->id()),
                TextInput::make('directed_by_position')
                    ->label('Cargo de quien dirige')
                    ->required()
                    ->placeholder('Seleccione o escriba un cargo')
                    ->datalist(fn () => Position::where('is_active', true)->orderBy('name')->pluck('name')->all())
                    ->helperText('Puede escoger una opción existente o escribir un cargo personalizado.')
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn (?string $state): ?string => filled($state) ? trim($state) : null),
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

}
