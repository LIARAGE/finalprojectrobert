<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Satu',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password: admin123
            'phone' => '081234567890',
            'role' => 'admin',
        ]);\App\Models\User::all();

    }
}