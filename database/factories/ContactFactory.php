<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone_one' => $this->faker->phoneNumber,
            'phone_two' => $this->faker->optional()->phoneNumber,
            'mail_one' => $this->faker->email,
            'mail_two' => $this->faker->optional()->email,
            'address' => $this->faker->address,
            'map_link' => $this->faker->url,
        ];
    }
}
