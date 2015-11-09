<?php

use App\Test;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 25) as $index)
        {
            Test::create([
                'url'=>$faker->url(),
                'test_running'=>1
            ]);
        }
    }
}
