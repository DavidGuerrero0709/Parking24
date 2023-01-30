<?php

namespace Database\Seeders;

use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['SuperAdministrador', 'Administrador', 'Cliente'];
        foreach ($roles as $role) {
            Roles::insert([
                'name'  =>  $role,
                'created_at'  =>  Carbon::now(),
                'updated_at'  =>  Carbon::now()
            ]);
        }
    }
}
