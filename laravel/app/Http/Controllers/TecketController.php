<?php
namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
class TecketController extends Controller{
    public function store(){
        $reservations = Reservation::with(['event', 'user'])
            ->where('user_id', Auth::id())
            ->latest() 
            ->get();
        return response()->json($reservations ,200);               
    }
//     public function download($id){

//     $reservation = Reservation::with(['event', 'user'])
//         ->where('id', $id)
//         ->where('user_id', Auth::id())
//         ->firstOrFail();

//     $reservations = collect([$reservation]);

//     $pdfView = view('clients.ticket', compact('reservations'))->render();

//     $pdf = Pdf::loadHTML($pdfView)->setPaper('a4', 'portrait');

//     return $pdf->download('Ticket-' . $reservation->ticket_reference . '.pdf');
// }
}




