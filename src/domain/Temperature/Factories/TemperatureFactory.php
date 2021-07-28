<?php

namespace Domain\Temperature\Factories;

use App\Models\User;
use Domain\Temperature\Models\Temperature;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemperatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Temperature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        return [
            'user_id' => $user->id,
            'city_id' => 1,
            'celsius' => round($this->faker->randomFloat(), 2),
            'fahrenheit' => round($this->faker->randomFloat(), 2),
        ];
    }
}
