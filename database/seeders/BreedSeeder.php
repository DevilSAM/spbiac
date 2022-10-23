<?php

namespace Database\Seeders;

use App\Models\Breed;
use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Breed::create([
            'name' => "Manul",
            'description' => 'Very dangerous cat',
            'long_life' => 15,
        ]);
    }
}
