<?php

namespace Database\Seeders\aclSeeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'permission.*']);
        Permission::create(['name' => 'permission.show']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.update']);
        Permission::create(['name' => 'permission.delete']);
    }
}
