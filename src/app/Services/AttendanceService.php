<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Support\Collection;

class AttendanceService
{
    public function register(array $data, Event $event): Attendance
    {
        $data['event_id'] = $event->id;
        $data['registered_at'] = now();

        return Attendance::create($data);
    }

    public function isAlreadyRegistered(Event $event, string $idNumber): bool
    {
        return Attendance::where('event_id', $event->id)
            ->where('id_number', $idNumber)
            ->exists();
    }

    public function getAttendancesByEvent(Event $event): Collection
    {
        return $event->attendances()
            ->with(['position', 'headquarter'])
            ->orderBy('registered_at', 'desc')
            ->get();
    }

    public function getAttendancesByAdmin(): Collection
    {
        return Attendance::whereHas('event', function ($query) {
            $query->where('directed_by_id', auth()->id());
        })
            ->with(['event', 'position', 'headquarter'])
            ->orderBy('registered_at', 'desc')
            ->get();
    }
}
