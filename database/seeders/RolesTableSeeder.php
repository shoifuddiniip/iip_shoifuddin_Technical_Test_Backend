<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            'Super Admin',
            'Customer Service',
            'Salesperson',
            'Operational',
            'Client'
        ];

        $index = 0;
        foreach ($roles as $role) {
            Role::create([
                'id' => 1 + $index,
                'name' => $role,
            ]);
            $index++;
        }
    }
}
