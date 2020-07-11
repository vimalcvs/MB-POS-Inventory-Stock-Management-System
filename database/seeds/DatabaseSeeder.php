<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(\App\Models\Settings::count() == 0){
            $this->call(AppSettings::class);
        }

        if (\Spatie\Permission\Models\Role::count() == 0){
            $this->call(RoleSeeder::class);
        }

        if(\Spatie\Permission\Models\Permission::count() == 0){
            $this->call(PermissionSeeder::class);
        }
    }
}
