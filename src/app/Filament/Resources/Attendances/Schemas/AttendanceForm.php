<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AttendanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('event_id')
                    ->required()
                    ->numeric(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('id_number')
                    ->required(),
                TextInput::make('position_id')
                    ->numeric(),
                TextInput::make('headquarter_id')
                    ->numeric(),
                Textarea::make('signature')
                    ->columnSpanFull(),
                DateTimePicker::make('registered_at')
                    ->required(),
            ]);
    }
}
