<?php

class FakeDataInstance
{
    public string $name;
    public string $color;
    public string $month;
    public string $weekday;
    public string $emoji;
    public string $bloodType;

    /**
     * @param string $name
     * @param string $color
     * @param string $month
     * @param string $weekday
     * @param string $emoji
     * @param string $bloodType
     */
    public function __construct(string $name, string $color, string $month, string $weekday, string $emoji, string $bloodType)
    {
        $this->name = $name;
        $this->color = $color;
        $this->month = $month;
        $this->weekday = $weekday;
        $this->emoji = $emoji;
        $this->bloodType = $bloodType;
    }


}