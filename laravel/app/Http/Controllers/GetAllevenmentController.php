<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class GetAllevenmentController extends Controller
{
    public function index(){
        $evenment = Event::withCount('reservations')->get();
        return view('clients.dashboard', compact('evenment'));
    }
    public function DetailEvent(){
        $Event = Event::withCount('reservations')->get();
        return view('admin.dashboard' , compact('Event'));
    }
}
