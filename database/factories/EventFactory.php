<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'state' => 'SP',
            'city' => 'São Paulo',
            'neighborhood' => 'Centro',
            'zipcode' => '01000-000',
            'number' => '123',
            'complement' => null,
            'date' => now()->addDays(rand(1, 30)),
            'created_by' => User::factory(),
        ];
    }
}
