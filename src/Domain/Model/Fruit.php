<?php

namespace Carolinasanches24\PhpPdo\Domain\Model;

class Fruit{
    private int $id;
    private string $name;
    private string $colour;
    private float $calories;

    public function __construct(string $name, string $colour, float $calories) {
        $this->name = $name;
        $this->colour = $colour;
        $this->calories = $calories;
    }

    public function __set($name, $value) {
        if ($name === 'id') {
            $this->id = (int) $value;
        } elseif ($name === 'name') {
            $this->name = (string) $value;
        } elseif ($name === 'colour') {
            $this->colour = (string) $value;
        } elseif ($name === 'calories') {
            $this->calories = (float) $value;
        }
    }

    public function getId():int{
        return $this->id;
    }
    public function getName():string{
        return $this->name;
    }

    public function getColour():string{
       return $this->colour;
    }
    public function getCalories():float{
        return $this->calories;
    }

}