<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        Department::create(['name' => 'MRS/Medical Centres/RAPs(IPSO)']);
        Department::create(['name' => 'Workshop BMED']);
        Department::create(['name' => 'Life Support/Trg Offr']);
        Department::create(['name' => 'Emergencies']);
        Department::create(['name' => 'Wards']);
        Department::create(['name' => 'Imaging']);
        Department::create(['name' => 'Technical Svc Admin/Stores']);
        Department::create(['name' => 'NICU/Maternity Theatre']);
        Department::create(['name' => 'Dialysis']);
        Department::create(['name' => 'Main Theatre']);
        Department::create(['name' => 'Electromed/Trg Offr']);
        Department::create(['name' => 'Medical Gas']);
        Department::create(['name' => 'Admin Office']);
    }
}
