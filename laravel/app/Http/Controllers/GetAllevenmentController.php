<?php

namespace App\Http\Controllers;

use App\Models\Event;

class GetAllevenmentController extends Controller
{
    public function index(){
        $evenment = Event::withCount('reservations')->latest()->get();
        return response()->json($evenment , 200);
    }
    public function DetailEvent(){
        $Event = Event::withCount('reservations')->get();
        return response()->json($Event , 200);
    }
    public function getEventsNotReserved(){
        $events = Event::doesntHave('reservations')->get();
        return response()->json($events , 200);
    }
}
