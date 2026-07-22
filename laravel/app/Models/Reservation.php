<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'event_id', 'ticket_reference'];

//     protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($reservation) {
//         do {
//             $code = 'BDE-2026-' . strtoupper(Str::random(5));
//         } while (static::where('ticket_reference', $code)->exists());

//         $reservation->ticket_reference = $code;
//     });
// }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
