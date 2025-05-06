<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Island;
use App\Models\TripType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //
    public function home(){
        $island = Island::all();
        $type = TripType::all();
        return Inertia::render('Home', [
            'island'=> $island,
            'type'=> $type
        ]);
    }
    public function about(){
        return Inertia::render('About');
    }
    public function contact(){
        return Inertia::render('Contact');
    }
    public function destination(){
        $destination = Destination::filter(request(['island','type', 'month']))->get();
        return Inertia::render('Destination/Index', [
            'destination'=> $destination
        ]);
    }
    public function reserve(){
        return Inertia::render('Reservation/Form');
    }
}
