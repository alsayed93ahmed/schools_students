<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    public function configure()
    {
        return $this->afterCreating(function (School $school) {
            for($i=1; $i < 4; $i++) {
                Student::factory()->create([
                    'school_id' => $school->id,
                    'order' => $i
            ]);
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
