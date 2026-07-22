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
        return view('admin.Reservation', compact('reservations'));
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:en_attente,confirmé,utilisé',
        ]);
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Statut de la réservation mis à jour avec succès!');
    }
    public function Create(CreateRequest $request)
{
    $validated = $request->validated();
    try {
        Event::create([
            'user_id' => Auth::id(),
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'date_time'    => $validated['datetime'], 
            'location'     => $validated['lieu'],
            'max_capacity' => $validated['max_people'],
        ]);
        return redirect()->back()->with('success', 'Événement créé avec succès !');
    } catch (\Throwable $e) {
        logger()->error('Event Creation Error: ' . $e->getMessage());
        return back()->with('error', 'Erreur: ' . $e->getMessage())->withInput();
    }
}
    public function Store() {}
}
