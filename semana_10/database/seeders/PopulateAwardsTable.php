<?php

namespace Database\Seeders;

use App\Models\Award;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PopulateAwardsTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

            for($i = 0; $i < 10; $i++){
                Award::create([
                    'description' => $faker->name(),
                    'local' => $faker->text(),
                    'value' => $faker->randomFloat(2, 100, 1000),
                    'amount' => $faker->numberBetween(1, 10),
                    'date' => $faker->date,
                ]);
            }

    }
}
