<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Reservation extends Model
{
    protected $fillable = ['user_id', 'event_id', 'ticket_reference'];

    // توليد تلقائي للـ ticket_reference فاش كيتكريا الحجز
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            // كايولد كود بحال: BDE-2026-A8B9D
            $reservation->ticket_reference = 'BDE-2026-' . strtoupper(Str::random(5));
        });
    }

    // هاد الحجز تابع لأين مستخدم؟
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // هاد الحجز تابع لأين حدث؟
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
