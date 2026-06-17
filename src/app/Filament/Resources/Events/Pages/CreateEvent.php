<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use App\Services\EventService;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['directed_by_id'] = auth()->id();

        $eventService = app(EventService::class);
        $data['slug'] = $eventService->generateSlug($data['topic']);

        return $data;
    }
}
