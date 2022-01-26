<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetName, 
            'number' => $this->faker->numberBetween(1, 1000),
            'zipcode' => $this->faker->regexify('[0-9]{8}'),
            'country' => 'Brasil',
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'neighborhood' => $this->faker->text(10),
            'complement' => rand(1, 2) == 1 ? $this->faker->text(10) : null,
            'latitude' => $this->faker->latitude(-90, 90),
            'longitude' => $this->faker->longitude(-180, 180),
        ];
    }
}
