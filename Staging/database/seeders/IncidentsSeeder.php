<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class IncidentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incidents')->insert([
            'incident_no' => Str::random(10),
            'police_ref' => Str::random(10).'@gmail.com',
            'title' =>Str::random(10),
            'date' => Str::random(5),
            'reported_by' =>Str::random(6),
            'status' => Str::random(5),
        ]);
    }
}
