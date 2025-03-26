<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\TicketGroup;
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
            'user_id' => User::factory(),
            'subject' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'category_id' => Category::factory(),
        ];
    }

    /**
     * Indicate that the ticket should be in a ticket group.
     */
    public function inTicketGroup(): static {
        return $this->state(fn (array $attributes) => [
            'ticket_group_id' => TicketGroup::factory(),
        ]);
    }

    /**
     * Indicate that the ticket is marked as completed.
     */
    public function completed(): static {
        return $this->state(fn (array $attributes) => [
            'is_completed' => true,
        ]);
    }
}
