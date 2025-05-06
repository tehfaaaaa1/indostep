<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Inertia\Inertia;
use App\Models\Expert;
use App\Models\Island;
use App\Models\TripType;
use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function destination(){
        return Inertia::render('Admin/Destination');
    }
    public function destinationCEF($slug = null) {
        $island = Island::all();
        $expert= Expert::all();
        $accomodation= Accomodation::all();
        $type= TripType::all();
        $destination = Destination::where('id', $slug)->first();
        if(!is_null($slug)){
            foreach($destination?->expert as $ex){
                $p = $ex->expert;
            }
            foreach($destination?->accomodation as $ac){
                $a= $ac->accomodation;
            }
        }
        return Inertia::render('Admin/DestinationCE',[
           'island' => $island,
           'expert'=> $expert,
           'accomodation'=> $accomodation,
           'type'=> $type,
           'destination'=> $destination 
        ]);
    }
    public function destinationCEB(Request $request) {
        
    }

    public function createExpertAxios(Request $request) {
        $validate = $request->validate([
            'name'=>'required',
            'skill'=> 'required',
            'bio' => 'required',
            'image'=>'nullable',
            'id'=>'nullable'
        ]);
        $filename= null;
        $exp = Expert::where('id', $validate['id'] ?? null)->first();
        if($request->hasFile('image')){
            if($exp?->foto && File::exists(public_path('img/expert/').$exp->image)){
                Storage::disk('public')->delete(public_path('img/expert/'). $exp->image);
                unlink(public_path('img/expert/').$exp->image);
            }
            $filename= $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/expert'), $filename);
        }
        $expert = Expert::firstOrNew(['id'=>$validate['id'] ?? null]);
        $expert->name = $validate['name'];
        $expert->skill = $validate['skill'];
        $expert->biography = $validate['bio'];
        $expert->image =  $filename ?? $validate['image'];
        $expert->save();
        $exall = Expert::all();
        return response()->json(['data'=> $expert, 'expertAll'=> $exall]);
    }
}
