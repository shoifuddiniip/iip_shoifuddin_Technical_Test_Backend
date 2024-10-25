<?php

namespace Database\Seeders;

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
        // Call the Roles seeder first to ensure roles are populated
        $this->call(RolesTableSeeder::class);

        // Then call the Users seeder
        $this->call(UsersTableSeeder::class);

        // Optionally, you can call other seeders like SalesTableSeeder
        // $this->call(SalesTableSeeder::class);
    }
}
