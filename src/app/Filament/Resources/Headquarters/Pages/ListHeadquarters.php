<?php

namespace App\Filament\Resources\Headquarters\Pages;

use App\Filament\Resources\Headquarters\HeadquarterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHeadquarters extends ListRecords
{
    protected static string $resource = HeadquarterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Crear sede'),
        ];
    }
}
