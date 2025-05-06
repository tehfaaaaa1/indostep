<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
