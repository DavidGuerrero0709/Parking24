<?php

namespace Database\Seeders;

use App\Models\Countries;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Countries::create([
            'name'    =>  'Colombia',
            'created_at'      =>  Carbon::now(),
            'updated_at'      =>  Carbon::now(),
        ]);
    }
}
