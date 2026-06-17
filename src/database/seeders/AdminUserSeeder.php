<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::where('email', 'admin@example.com')->doesntExist()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('admin123'),
                'is_admin' => true,
            ]);
            $this->command->info('Admin user created: admin@example.com / admin123');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
