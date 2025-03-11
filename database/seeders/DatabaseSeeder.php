<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            CitySeeder::class,
            FormSeeder::class,
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