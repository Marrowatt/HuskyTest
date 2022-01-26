<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $client = User::select('id')->where('user_type_id', 1)->inRandomOrder()->first();
        $deliver = User::select('id')->where('user_type_id', 3)->inRandomOrder()->first();

        return [
            'user_id' => $client->id,
            'deliver_id' => $deliver->id,
            'collect_point_id' => rand(1, 4),
            'destination_point_id' => rand(1, 4),
            'status_id' => rand(1, 4)
        ];
    }
}
