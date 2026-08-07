<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ReserverEventController extends Controller{
    public function store($id){
        $event = Event::findOrFail($id);
        $existingReservation = Reservation::where('user_id', Auth::id())
                                          ->where('event_id', $event->id)
                                          ->first();
        if ($existingReservation) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vous êtes déjà inscrit à cet événement !'
            ], 400);
        }
        if ($event->reservations()->count() >= $event->max_capacity) {
            return response()->json([
                'status' => 'error',
                'message' =>  'Désolé, cet événement est complet !'
            ], 400);
        }
        $ticketRef = 'BDE-'. now()->format('Y') . '-' . Str::upper(Str::random(8));
        $reservation = Reservation::create([
            'user_id'          => Auth::id(),
            'event_id'         => $event->id,
            'ticket_reference' => $ticketRef,
        ]);
        return response()->json([
            'status'  => 'success',
            'message' => 'Réservation effectuée avec succès !',
            'data'    => [
                'ticket_reference' => $ticketRef,
                'reservation'      => $reservation
            ]
        ], 201);    }
}



