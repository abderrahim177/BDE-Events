<?php

namespace App\Http\Controllers;

use App\Models\Event;

class GetAllevenmentController extends Controller
{
    public function index(){
        $evenment = Event::withCount('reservations')->latest()->get();
        return view('clients.dashboard', compact('evenment'));
    }
    public function DetailEvent(){
        $Event = Event::withCount('reservations')->get();
        return view('admin.dashboard' , compact('Event'));
    }
    public function getEventsNotReserved(){
        $events = Event::doesntHave('reservations')->get();
        return view('/welcome' , compact('events'));
    }
}
