<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'event_id',
        'full_name',
        'id_number',
        'position_id',
        'headquarter_id',
        'signature',
        'registered_at',
    ];

    protected $casts = [
        'registered_at' => 'date',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }
}
