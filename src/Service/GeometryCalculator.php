<?php

namespace App\Service;

class GeometryCalculator
{
    function circle_surface(float $radius): float
    {
        return number_format(pi() * $radius * $radius, 2);
    }

    function circle_circumference(float $radius): float
    {
        return number_format(2 * pi() * $radius, 2);
    }

    function triangle_surface($a, $b, $c): ?float
    {
        if ($this->check_if_possible($a, $b, $c)) {
            $s = ($a + $b + $c) / 2;
            $surface = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));
            return number_format($surface, 2);
        } else {
            return null;
        }
    }

    function triangle_circumference($a, $b, $c): ?float
    {
        if ($this->check_if_possible($a, $b, $c)) {
            return $a + $b + $c;
        } else {
            return null;
        }
    }

    function sum_surface($surface1, $surface2): float
    {

        return $surface1 + $surface2;
    }

    function sum_circumference($circumference1, $circumference2): float
    {
        return $circumference1 + $circumference2;
    }

    function check_if_possible($a, $b, $c): bool
    {
        if ($a + $b <= $c || $a + $c <= $b || $b + $c <= $a ) {
            return false;
        } else {
            return true;
        }
    }
}