<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'date_time', 'location', 'price', 'max_capacity'];

    // الحجوزات للي تدارو لهاد الحدث
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    // دالة لحساب المقاعد المتبقية في الوقت الحقيقي (US 1.2)
    public function remainingPlaces(): int
    {
        $reservedCount = $this->reservations()->count();
        return $this->max_capacity - $reservedCount;
    }

    // دالة كتعلمنا واش الحدث عامر ومبقاش فيه البلايص
    public function isFull(): bool
    {
        return $this->remainingPlaces() <= 0;
    }
}
