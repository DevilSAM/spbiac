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
            'name' => "Манул",
            'description' => 'Очень злой',
            'long_life' => 15,
        ]);
    }
}
