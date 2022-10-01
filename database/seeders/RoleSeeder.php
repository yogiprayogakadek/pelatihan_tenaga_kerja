<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            'Admin', 'Assessor', 'Participant'
        ];

        foreach($role as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
