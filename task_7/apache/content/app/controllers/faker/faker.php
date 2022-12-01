<?php

require_once '../vendor/autoload.php';
require_once 'FakeDataInstance.php';

function generate_data()
{
    $data = array();

    $faker = Faker\Factory::create();
    $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
    $faker->addProvider(new Faker\Provider\ru_RU\Color($faker));
    for ($i = 0; $i < 50; $i++) {
        $data_row = new FakeDataInstance(
            $faker->name(),
            $faker->colorName(),
            $faker->monthName(),
            $faker->dayOfWeek(),
            $faker->emoji(),
            $faker->bloodType()
        );
        $data[] = $data_row;
    }
    $jsonData = json_encode($data);
    file_put_contents('results.json', $jsonData);
}
