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
            OrderSeeder::class
        ]);

        $streamer = Form::factory()->create()->user;
        //Create test streamer
        $streamer->update([
            'name' => 'Стример',
            'isStreamer' => 'true',
            'phone' => '+79112223344',
            'email' => "streamer@mail.ru",
            'password' => Hash::make('streamer'),
        ]);

        $user = User::factory()->create();
        //Create test user
        $user->update([
            'name' => 'User',
            'isStreamer' => '',
            'phone' => '+79223334455',
            'email' => "user@mail.ru",
            'password' => Hash::make('user'),
        ]);

    }
}