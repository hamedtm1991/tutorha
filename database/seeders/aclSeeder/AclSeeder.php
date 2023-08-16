<?php

namespace Database\Seeders\aclSeeder;

use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            SuperAdminSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class
        ]);
    }
}
