<?php

namespace Database\Factories;

use App\Models\Astrologer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Astrologer>
 */
class AstrologerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid,
            'name' => $this->faker->name(),
            'photo' => $this->faker->randomElement(['(~‾▿‾)~', '(╯°□°）╯', '٩( ᐛ )و', '¯\_(ツ)_/¯', '(👁 ͜ʖ👁)', 'ツ']),
            'email' => $this->faker->unique()->safeEmail(),
            'biography' => $this->faker->words(3, true),
        ];
    }
}
