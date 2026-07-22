<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
class CreateEvenmentController extends Controller
{
    public function index() {}
    public function adminIndex() {}
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
