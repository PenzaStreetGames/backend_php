<?php

namespace app\models;

use app\models\FakeDataInstance;
use Faker\Factory;
use Faker\Provider;

class FakeDataModel {

    static $jsonPath = 'results.json';

    function getData()
    {

    }

    function generateData()
    {
        $data = array();
        $faker = Factory::create();
        $faker->addProvider(new Provider\ru_RU\Person($faker));
        $faker->addProvider(new Provider\ru_RU\Color($faker));
        for ($i = 0; $i < 50; $i++) {
            $data_row = new FakeDataInstance(
                $faker->name(),
                $faker->colorName(),
                $faker->monthName(),
                $faker->dayOfWeek(),
                $faker->emoji(),
                $faker->bloodType(),
                $faker->randomFloat(3, 0, 1),
                $faker->randomFloat(3, 0, 1)
            );
            $data[] = $data_row;
        }
        return $data;
    }

    function getDayCount($data): array
    {
        $day_count = array();
        foreach ($data as $row) {
            $weekday = $row->weekday;
            if(!isset($day_count[$weekday])) {
                $day_count[$weekday] = 0;
            }
            $day_count[$weekday] += 1;
        }
        return $this->getLabelsAndValues($day_count);
    }

    function getBloodTypeCount($data): array
    {
        $blood_type_count = array();
        foreach ($data as $row) {
            $bloodType = $row->bloodType;
            if(!isset($blood_type_count[$bloodType])) {
                $blood_type_count[$bloodType] = 0;
            }
            $blood_type_count[$bloodType] += 1;
        }
        return $this->getLabelsAndValues($blood_type_count);
    }

    function getXYTuple($data): array {
        $x = array();
        $y = array();
        foreach ($data as $row) {
            $x[] = $row->random_x;
            $y[] = $row->random_y;
        }
        return array(
            "x" => $x,
            "y" => $y,
        );
    }

    function getLabelsAndValues($data) {
        $labels = array_keys($data);
        $values = array_values($data);
        return array("labels" => $labels, "values" => $values);
    }
}