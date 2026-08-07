<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Event;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CreateEvenmentController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'event'])
            ->latest()
            ->paginate(10); 
        return response()->json($reservations , 200);
    }
    // public function updateStatus(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|in:en_attente,confirmé,utilisé',
    //     ]);
    //     $reservation = Reservation::findOrFail($id);
    //     $reservation->update([
    //         'status' => $request->status
    //     ]);
    //     return redirect()->back()->with('success', 'Statut de la réservation mis à jour avec succès!');
    // }
    public function Create(CreateRequest $request)
{
    $validated = $request->validated();
    try {
        Event::create([
            'user_id'      => Auth::id(),
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'date_time'    => $validated['datetime'], 
            'location'     => $validated['lieu'],
            'max_capacity' => $validated['max_people'],
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'evenment creat with success'
        ], 200);

    } catch (\Throwable $e) {
        logger()->error('Event Creation Error: ' . $e->getMessage());
        return response()->json([
                'status'  => 'error',
                'message' => 'Une erreur s’est produite lors de la création de l’événement.',
                'error'   => $e->getMessage() 
            ], 500);
    }
}
}
