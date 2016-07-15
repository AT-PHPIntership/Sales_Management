<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'SuperAdmin'
        ]);

        Role::create([
            'name' => 'Manager'
        ]);

        Role::create([
            'name' => 'Staff'
        ]);
    }
}
