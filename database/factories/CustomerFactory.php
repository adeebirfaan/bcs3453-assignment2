<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define one fake customer using Faker.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => fake()->name(),
            'email'       => fake()->unique()->email(),   // unique() avoids duplicate emails
            'address'     => fake()->address(),
            'phoneNumber' => fake()->phoneNumber(),
            'gender'      => fake()->randomElement(['Male', 'Female']),
            // Birthday: Faker has no birthday() method, so a random date of birth
            // between 1970 and 2010 is generated. This also makes sure some
            // customers are born after 2000 for the birthday filter.
            'birthday'    => fake()->dateTimeBetween('1970-01-01', '2010-12-31')->format('Y-m-d'),
        ];
    }
}
