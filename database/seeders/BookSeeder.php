<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) { 
            Book::create([
                'title' => $faker->sentence(3),
                'author' => $faker->name(),
                'published_date' => $faker->date(),
            ]);
        }
    }
}
