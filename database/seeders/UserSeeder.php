<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create([
            'name' => 'Test User',
        ]);
        User::create([
            'name' => 'Макс',
            'isStreamer' => 'true',
            'phone' => '+79522017630',
            'email' => "admin@mail.ru",
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now()
        ]);
    }
}