<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['user_id','title', 'description', 'date_time', 'location', 'price', 'max_capacity'];

    // les reservation li tdaro lhad l7adat
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    // had kat7seb ch7al diyal lblays ba9in fhad l7dat 
    public function remainingPlaces(): int
    {
        $reservedCount = $this->reservations()->count();
        return $this->max_capacity - $reservedCount;
    }

    // hadi kat3lamna wach l7adat 3amer wla ba9i fih blays
    public function isFull(): bool
    {
        return $this->remainingPlaces() <= 0;
    }
    public function organizer()
{
    return $this->belongsTo(User::class, 'user_id');
}
// نجيبو كاع المستخدمين اللي حجزوا فـ هاد الحدث
public function attendees()
{
    return $this->belongsToMany(User::class, 'reservations')
                ->withPivot('status', 'ticket_reference')
                ->withTimestamps();
}
}
