<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class islandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('islands')->insert([
            ['name'=>'Sumatra'],
            ['name'=>'Jawa'],
            ['name'=>'Kalimantan'],
            ['name'=>'Sulawesi'],
            ['name'=>'Papua'],
            ['name'=>'Alor'],
            ['name'=>'Bacan'],
            ['name'=>'Bali'],
            ['name'=>'Banggai'],
            ['name'=>'Bangka'],
            ['name'=>'Belitung'],
            ['name'=>'Halmahera'],
            ['name'=>'Lombok'],
            ['name'=>'Flores'],
            ['name'=>'Sumba'],
            ['name'=>'Taliabu'],
            ['name'=>'Wetar'],
            ['name'=>'Nias'],
            ['name'=>'Yapen'],
        ]);
    }
}
