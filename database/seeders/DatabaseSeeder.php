<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pehle roles seed honge
        $this->call(RoleSeeder::class);

        // Optional: Agar tum admin user create karna chahte ho seed se
        // Uncomment if needed:

        // \App\Models\User::factory()->create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'role_id' => 1, // Admin
        // ]);
    }
}
