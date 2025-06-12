<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Clinician']);
        Role::create(['name' => 'Technician']);
        Role::create(['name' => 'Engineer']);
        Role::create(['name' => 'In-Charge']);
        Role::create(['name' => 'Overall In-Charge']);
    }
}
