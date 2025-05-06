<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Island;
use App\Models\TripType;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryReceivedNotification;

class UserController extends Controller
{
    //
    public function home()
    {
        $island = Island::all();
        $type = TripType::all();
        return Inertia::render('Home', [
            'island' => $island,
            'type' => $type
        ]);
    }
    public function about()
    {
        return Inertia::render('About');
    }
    public function contact()
    {
        return Inertia::render('Contact');
    }
    public function destinationDetail($id) {
        $destinations = Destination::where('id', $id)->get();
        if(!is_null($id)){
            foreach($destinations as $destination){
                foreach($destination?->expert as $ex){
                    $p = $ex->expert;
                }
                foreach($destination?->accomodation as $ac){
                    $a= $ac->accomodation;
                }
            }
        }
        $desti = collect($destinations)->map(function ($dest) {
            return [
                'id'=> $dest->id,
                'destination'=> $dest->destination,
                'island_id'=> $dest->island_id,
                'trip_type_id'=> $dest->trip_type_id,
                'overview'=> json_decode($dest->overview),
                'itinerary'=> json_decode($dest->itinerary),
                'image'=> $dest->image,
                'created_at'=> $dest->created_at,
                'updated_at'=> $dest->updated_at,
                'expert'=> $dest->expert,
                'accomodation'=> $dest->accomodation,
                'expedition'=>$dest->expedition,
                'type'=> $dest->type
            ];
        })->first();
        return Inertia::render('Destination/Detail',[
           'destination'=> $desti,
        ]);
    }
    public function destination()
    {
        $destination = Destination::filter(request(['island', 'type', 'month']))->get();
        return Inertia::render('Destination/Index', [
             'destination'=> collect($destination)->map(function ($des) {
                return [
                    'id'=> $des->id,
                    'destination'=> $des->destination,
                    'island_id'=>$des->island_id,
                    'trip_type_id'=> $des->trip_type_id,
                    'image'=> $des->image,
                    'type'=> $des->type,
                    'expedition'=> $des->expedition,
                    'overview'=> json_decode($des->overview),
                    'itinerary'=> json_decode($des->itinerary),
                    'expert'=> $des->expert,
                    'accomodation'=> $des->accomodation
                ];
            })
        ]);
    }
    public function reserve()
    {
        return Inertia::render('Reservation/Form');
    }
    public function reservePost()
    {
        try {
            Mail::to('fateeh.falah.itxpro@gmail.com')
                ->send(new InquiryReceivedNotification('yey'));

            return redirect()->back()->with('success', 'Your inquiry has been sent!');
        } catch (\Exception $e) {
            // Log the error if email sending fails
            Log::error('Failed to send inquiry email: ' . $e->getMessage());

            // --- Respond back to the frontend (Inertia) on failure ---
            return redirect()->back()->with('error', 'There was an issue sending your inquiry. Please try again.');
        }
    }
}
