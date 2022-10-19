<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Seeder;

class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cat::create([
              'name' => "Meowth",
              'image' => 'https://cdn2.thecatapi.com/images/ea7.jpg',
              'age' => 2,
              'breed_id' => 1,
          ]);
    }
}
