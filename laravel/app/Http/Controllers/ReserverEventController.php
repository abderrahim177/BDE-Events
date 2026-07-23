<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ReserverEventController extends Controller
{
    public function store($id)
    {
        $event = Event::findOrFail($id);
        $existingReservation = Reservation::where('user_id', Auth::id())
                                          ->where('event_id', $event->id)
                                          ->first();
        if ($existingReservation) {
            return redirect()->back()->with('error', 'Vous êtes déjà inscrit à cet événement !');
        }
        if ($event->reservations()->count() >= $event->max_capacity) {
            return redirect()->back()->with('error', 'Désolé, cet événement est complet !');
        }
        $ticketRef = 'BDE-'. NOW() . strtoupper(Str::random(8));
        Reservation::create([
            'user_id'          => Auth::id(),
            'event_id'         => $event->id,
            'ticket_reference' => $ticketRef,
        ]);
        return redirect()->back()->with('success', 'Réservation effectuée avec succès ! Code: ' . $ticketRef);
    }
    public function myTickets(){

    }
}
