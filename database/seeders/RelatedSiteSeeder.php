<?php

namespace Database\Seeders;

use App\Models\RelatedSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelatedSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            RelatedSite::create([
                'name' => $faker->sentence(1),
                'url' => $faker->url(),
            ]);
        }
    }
}
