<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Branch Manager',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'Sell Executive',
            'guard_name' => 'web'
        ]);
    }
}
