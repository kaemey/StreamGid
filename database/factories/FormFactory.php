<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $user->update(['avatar' => "storage/avatars/" . $user->id . ".jpg"]);
        return [
            'city_id' => City::all()->random(),
            'about' => fake()->text(),
            'user_id' => $user->id,
        ];
    }
}