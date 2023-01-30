<?php

namespace Database\Seeders;

use App\Models\Cities;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Bogota',
            'Medellin',
            'Cali',
            'Pereira',
            'Barranquilla',
            'Manizales',
            'Ibague',
            'Armenia',
            'Risaralda',
        ];

        foreach ($cities as $city) {
            Cities::insert([
                'name'        =>  $city,
                'country_id'  =>  '1',
                'created_at'         =>  Carbon::now(),
                'updated_at'         =>  Carbon::now(),
            ]);
        }
    }
}
