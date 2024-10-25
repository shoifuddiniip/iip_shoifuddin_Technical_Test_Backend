<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Check if the user already exists
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin User', // You can set a name for the user
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'), // Hashing the password
                'role_id' => 1, // Assuming '1' corresponds to Super Admin role, adjust as necessary
            ]);
        }
    }
}
