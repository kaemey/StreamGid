<?php

namespace Database\Seeders;
use App\Models\Form;
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

        $admin = Form::factory()->create()->user;
        //Create admin
        $admin->update([
            'name' => 'Макс',
            // 'isStreamer' => '',
            'isStreamer' => 'true',
            'phone' => '+79522017630',
            'email' => "admin@mail.ru",
            'password' => Hash::make('admin'),
        ]);

    }
}