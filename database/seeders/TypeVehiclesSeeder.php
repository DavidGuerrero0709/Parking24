<?php

namespace Database\Seeders;

use App\Models\TypeVehicles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeVehiclesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeVehicles = [
                  'Motocicleta',
                  'Motocarro',
                  'Mototriciclo', 
                  'Cuatrimoto', 
                  'Automovil', 
                  'Campero', 
                  'Camioneta', 
                  'Microbus', 
                  'Bus', 
                  'Buseta', 
                  'Camion', 
                  'Tractocamion', 
                  'Volqueta', 
                  'Coupe', 
                  'Hatchback', 
                  'Sedan', 
                  'Limosina', 
                  'Pico', 
                  'Van'
                ];
        foreach ($typeVehicles as $type) {
            TypeVehicles::insert([
                'name'        =>  $type,
                'created_at'  =>  Carbon::now(),
                'updated_at'  =>  Carbon::now()
            ]);
        }
    }
}
