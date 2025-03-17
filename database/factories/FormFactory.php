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
        $timing = '1:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';2:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';3:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';4:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';5:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';6:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';7:' . fake()->randomFloat(0, 0, 1) . ':' . fake()->randomFloat(0, 10, 15) . ':' . fake()->randomFloat(0, 17, 22) . ';';
        $user = User::factory()->create();
        $user->update(['avatar' => "storage/avatars/" . $user->id . ".jpg"]);
        return [
            'city_id' => City::all()->random(),
            'about' => fake()->text(),
            'user_id' => $user->id,
            'active' => '1',
            'timing' => $timing,
        ];
    }
}