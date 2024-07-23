<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Credential;
use App\Models\User;

class CredentialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Credential::class;

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
            'issuer' => $this->faker->word(),
            'issue_date' => $this->faker->dateTime(),
            'expire_date' => $this->faker->dateTime(),
            'approve_date' => $this->faker->dateTime(),
            'approver_comment' => $this->faker->text(),
            'approver_id' => User::factory(),
            'user_id' => User::factory(),
        ];
    }
}
