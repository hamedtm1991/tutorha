<?php

namespace Database\Seeders\aclSeeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'tutor.*']);
        Permission::create(['name' => 'tutor.show']);
        Permission::create(['name' => 'tutor.create']);
        Permission::create(['name' => 'tutor.update']);
        Permission::create(['name' => 'tutor.delete']);
    }
}
