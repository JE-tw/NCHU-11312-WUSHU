<?php

namespace Database\Factories;

use App\Models\ContactRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactRecord>
 */
class ContactRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = ContactRecord::class;
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->name,
            'phone' => '09' . $this->faker->numerify('########'),
            'email' => $this->faker->safeEmail,
            'title' => '古典針灸基礎班如果不小心點中啞穴怎辦？',
            'content' => '古典針灸基礎班如果不小心點中啞穴怎辦？這樣會不會害同學永遠不能說話',
        ];
    }
}
