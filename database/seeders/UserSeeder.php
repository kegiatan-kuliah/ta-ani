<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => bcrypt(123456789),
            'role' => 'admin',
            'is_active' => true
        ]);
    }
}
