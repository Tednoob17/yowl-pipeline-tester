<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Browser>
 */
class BrowserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fake_browser = $this->faker->randomElement(['Mobile', 'Tablet', 'Desktop', 'Bot', 'Other']);
        return [
            'name' => $fake_browser,
            'user_id' => User::factory(),
        ];
    }
}
