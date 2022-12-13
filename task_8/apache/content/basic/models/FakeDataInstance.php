<?php

class FakeDataInstance
{
    public string $name;
    public string $color;
    public string $month;
    public string $weekday;
    public string $emoji;
    public string $bloodType;
    public float $random_x;
    public float $random_y;

    /**
     * @param string $name
     * @param string $color
     * @param string $month
     * @param string $weekday
     * @param string $emoji
     * @param string $bloodType
     * @param float $random_x
     * @param float $random_y
     */
    public function __construct(string $name, string $color, string $month, string $weekday, string $emoji, string $bloodType, float $random_x, float $random_y)
    {
        $this->name = $name;
        $this->color = $color;
        $this->month = $month;
        $this->weekday = $weekday;
        $this->emoji = $emoji;
        $this->bloodType = $bloodType;
        $this->random_x = $random_x;
        $this->random_y = $random_y;
    }


}