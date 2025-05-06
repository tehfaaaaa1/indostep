<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('trip_types')->insert([
            ['name'=>'Hiking'],
            ['name'=>'History & Archeology'],
            ['name'=>'Kayaking & Rafting'],
            ['name'=>'Nature & Wildlife'],
            ['name'=>'People & Culture'],
            ['name'=>'Snorkeling & Diving'],
        ]);
    }
}
