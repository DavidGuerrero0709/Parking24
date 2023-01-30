<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::insert([
            'name'            =>  'Wilmar David',
            'last_name'       =>  'Macias Guerrero',
            'email'           =>  'davidguerrero0709@gmail.com',
            'phone'           =>  '3024786575',
            'address'         =>  'Calle 65 # 73A - 29',
            'neightboarhood'  =>  'Perdomo',
            'city_id'         =>  '1',
            'role_id'         =>  '1',
            'password'        =>  Hash::make('cronaldo717'),
            'created_at'      =>  Carbon::now(),
            'updated_at'      =>  Carbon::now(),
            'sex'             =>  'M',
        ]);

    }
}
