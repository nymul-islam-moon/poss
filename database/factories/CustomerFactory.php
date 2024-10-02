<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    protected $model = Customer::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'address_line1' => $this->faker->streetAddress,
            'address_line2' => $this->faker->optional()->secondaryAddress,
            'postal_code' => $this->faker->postcode,
            'city_corporation' => $this->faker->city,
            'upazila' => $this->faker->word,
            'zillah' => $this->faker->word,
            'district' => $this->faker->word,
            'country' => $this->faker->country,
            'data_of_birth' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'gender' => $this->faker->randomElement([1, 2]),
            'notes' => $this->faker->sentence,
            'created_by' => null,
        ];
    }
}
