<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Credential;
use App\Models\Credential_Attachment;
use App\Models\User;

class CredentialAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CredentialAttachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'filename' => $this->faker->word(),
            'type' => $this->faker->word(),
            'size' => $this->faker->numberBetween(-10000, 10000),
            'url' => $this->faker->url(),
            'review_date' => $this->faker->dateTime(),
            'reviewer_id' => User::factory(),
            'credential_id' => Credential::factory(),
        ];
    }
}
