<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'created_by' => 28,
            'assigned_to' => 18,
            'subject' => fake()->title(),
            'description' => fake()->paragraph,
            'category_id' => 9,
            'classroom_id' => 1,
        ];
    }
}
