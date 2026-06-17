<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use App\Models\Event;
use App\Services\QrCodeService;
use Filament\Resources\Pages\ViewRecord;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

    protected string $view = 'filament.resources.events.pages.view-event';

    public function getEvent(): Event
    {
        return $this->record;
    }

    public function getQrCodeSvg(): string
    {
        $qrService = app(QrCodeService::class);
        return $qrService->generateSvg($this->record);
    }

    public function getPublicUrl(): string
    {
        $qrService = app(QrCodeService::class);
        return $qrService->getPublicUrl($this->record);
    }
}
