<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\DestinationAccomodation;
use App\Models\DestinationExpert;
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
        $destination = Destination::all();
        foreach($destination as $d){
            $a= $d->type;
            foreach($d->expert as $p){
                $c= $p->expert;
            }
            foreach($d->accomodation as $a){
                $b= $a->accomodation;
            }
        }
        return Inertia::render('Admin/Destination',[
            'destination'=> $destination
        ]);
    }
    public function destinationCEF($slug = null) {
        $alrt = request()->session()->get('alrt');
        $island = Island::all();
        $expert= Expert::all();
        $accomodation= Accomodation::all();
        $type= TripType::all();
        $destinations = Destination::where('id', $slug)->get();
        if(!is_null($slug)){
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
            ];
        })->first();
        return Inertia::render('Admin/DestinationCE',[
           'island' => $island,
           'expert'=> $expert,
           'accomodation'=> $accomodation,
           'type'=> $type,
           'destination'=> $desti,
           'alrt'=> $alrt
        ]);
    }
    public function destinationCEB(Request $request) {
        $validate = $request->validate([
            'image'=>'nullable',
            'name'=>'nullable',
            'island'=>'nullable',
            'id'=>'nullable',
            'expert'=>'nullable',
            'type'=>'nullable',
            'accomodation'=>'nullable',
            'itinerary'=>'nullable',
            'overview'=>'nullable',
        ]);
        $destinasi = Destination::where('id', $validate['id'] ??null)->first();
        $filename = null;
        if($request->hasFile('image')){
            if($destinasi?->foto && File::exists(public_path('img/destination/').$destinasi->image)){
                Storage::disk('public')->delete(public_path('img/destination/'). $destinasi->image);
                unlink(public_path('img/destination/').$destinasi->image);
            }
            $filename= $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/destination'), $filename);
        }
        foreach($validate['itinerary'] as &$i){
            $i['show'] = false;
        }
        $destination = Destination::firstOrNew(['id'=> $validate['id'] ?? null]);
        $destination->destination = $validate['name'];
        $destination->trip_type_id = $validate['type'];
        $destination->island_id = $validate['island'];
        $destination->overview = json_encode($validate['overview']);
        $destination->itinerary = json_encode($validate['itinerary']);
        $destination->image = $filename ?? $validate['image'];
        $destination->save();

        $existingExpert = DestinationExpert::where('destination_id', $destination->id)->get()->keyBy('id');
        $processedExpertIds = [];
        foreach($validate['expert'] as $exp){
            $desexp = DestinationExpert::firstOrNew(['id'=> $exp['id_exdes'] ?? null]);
            $desexp->destination_id = $destination->id;
            $desexp->expert_id = $exp['id'];
            $desexp->save();
            $processedExpertIds[]= $desexp->id;
        }
        $existingExpert->except($processedExpertIds)->each(function ($exp) {
            $exp->delete();
        });
        $existingAccomodation = DestinationAccomodation::where('destination_id', $destination->id)->get()->keyBy('id');
        $processedAccomodationIds = [];
        foreach($validate['accomodation'] as $acc){
            $desacc = DestinationAccomodation::firstOrNew(['id'=> $acc['id_desacc'] ?? null]);
            $desacc->destination_id = $destination->id;
            $desacc->accomodation_id = $acc['id'];
            $desacc->save();
            $processedAccomodationIds[]= $desacc->id;
        }
        $existingAccomodation->except($processedAccomodationIds)->each(function ($acc) {
            $acc->delete();
        });
        return redirect()->route('admin.destinationCEF', $destination->id)->with(['alrt'=>'Save']);
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

    public function createAccomodationAxios(Request $request) {
        $validate = $request->validate([
            'name'=>'required',
            'desc'=> 'required',
            'address' => 'required',
            'image'=>'nullable',
            'id'=>'nullable'
        ]);
        $filename= null;
        $acc = Accomodation::where('id', $validate['id'] ?? null)->first();
        if($request->hasFile('image')){
            if($acc?->foto && File::exists(public_path('img/accomodation/').$acc->image)){
                Storage::disk('public')->delete(public_path('img/accomodation/'). $acc->image);
                unlink(public_path('img/accomodation/').$acc->image);
            }
            $filename= $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img/accomodation'), $filename);
        }
        $accomodation = Accomodation::firstOrNew(['id'=>$validate['id'] ?? null]);
        $accomodation->name = $validate['name'];
        $accomodation->description = $validate['desc'];
        $accomodation->address = $validate['address'];
        $accomodation->image =  $filename ?? $validate['image'];
        $accomodation->save();
        $exall = Accomodation::all();
        return response()->json(['data'=> $accomodation, 'accomodationAll'=> $exall]);
    }
}
