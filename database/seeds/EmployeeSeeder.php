<?php

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Customer;
use App\Models\Supplier;
use App\User;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::first();

        $role = \Spatie\Permission\Models\Role::first();
        $user->assignRole($role->name);

        $department = Department::create(['title' => 'Marketing']);
        $designation = Designation::create(['title' => 'Manager']);

        $branch = Branch::create([
            'title' => 'Main Branch',
            'phone' => '+12345678',
            'address' => 'Address Here'
        ]);

        Employee::create([
            'user_id' => $user->id,
            'department_id' => $department->id,
            'designation_id' => $designation->id,
            'branch_id' => $branch->id,
        ]);

        Supplier::create([
            'company_name' => 'ABC Supplier',
            'contact_person' => 'John Doe',
            'phone' => '+123 456 789',
            'email' => 'supplier@domain.com',
            'address' => 'Address Here',
        ]);
    }
}
