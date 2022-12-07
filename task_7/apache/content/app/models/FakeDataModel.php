<?php
require_once "app/models/FakeDataInstance.php";

class FakeDataModel extends Model {

    static $jsonPath = 'json/results.json';

    function getData()
    {

    }

    function generateData()
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
        file_put_contents(self::$jsonPath, $jsonData);
    }

    function getRawData(): array {
        $input = file_get_contents(self::$jsonPath);
        return json_decode($input);
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

    function getMonthCount($data): array
    {
        $count = array();
        foreach ($data as $row) {
            $value = $row->month;
            if(!isset($count[$value])) {
                $count[$value] = 0;
            }
            $count[$value] += 1;
        }
        return $count;
    }

    function getDayBloodTuple(): array {
        $data = $this->getRawData();
        $blood_array = array();
        $day_array = array();
        $blood_keys = array();
        $day_keys = array();
        foreach ($data as $row) {
            if (!in_array($row->weekday, $day_keys)) {
                $day_keys[] = $row->weekday;
            }
            if (!in_array($row->bloodType, $blood_keys)) {
                $blood_keys[] =$row->bloodType;
            }
        }
        $day_keys = array_flip($day_keys);
        $blood_keys = array_flip($blood_keys);
        foreach ($data as $row) {
            $day_array[] = $day_keys[$row->weekday];
            $blood_array[] = $blood_keys[$row->bloodType];
        }
        return array(
            "day" => $day_array,
            "blood" => $blood_array,
            "day_keys" => array_values($day_keys),
            "blood_keys" => array_values($blood_keys)
        );
    }

    function getLabelsAndValues($data) {
        $labels = array_keys($data);
        $values = array_values($data);
        return array("labels" => $labels, "values" => $values);
    }
}