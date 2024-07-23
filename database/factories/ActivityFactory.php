<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Activity;
use App\Models\User;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => $this->faker->word(),
            'provider' => $this->faker->word(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'hours' => $this->faker->numberBetween(-10000, 10000),
            'approve_date' => $this->faker->dateTime(),
            'approver_comment' => $this->faker->text(),
            'approver_id' => User::factory(),
            'user_id' => User::factory(),
        ];
    }
}
