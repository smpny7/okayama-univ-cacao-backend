<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @noinspection PhpUndefinedMethodInspection
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word() . '部',
            'login_id' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'),
        ];
    }
}
