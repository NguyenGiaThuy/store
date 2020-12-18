<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 20),
            'real_name'=>$this->faker->name,
            'address'=>$this->faker->address,
            'email'=>$this->faker->unique()->safeEmail,
            'phone_number'=>$this->faker->unique()->phoneNumber,
            'avatar'=>'https://static.scientificamerican.com/sciam/cache/file/92E141F8-36E4-4331-BB2EE42AC8674DD3_source.jpg'
        ];
    }
}
