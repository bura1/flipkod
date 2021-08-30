<?php

namespace App\Controller;

use App\Service\GeometryCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CircleController
{
    /**
     * @Route("/circle/{radius1}/{radius2}", defaults={"radius2"=0})
     */
    public function circle($radius1, $radius2)
    {
        $geometryCalculator = new GeometryCalculator();

        $surface1 = $geometryCalculator->circle_surface($radius1);
        $circumference1 = $geometryCalculator->circle_circumference($radius1);

        $json = ['type' => 'circle1',
                'radius' => floatval($radius1),
                'surface' => $surface1,
                'circumference' => $circumference1];

        if ($radius2 != 0) {
            $surface2 = $geometryCalculator->circle_surface($radius2);
            $circumference2 = $geometryCalculator->circle_circumference($radius2);
            $sum_surface = $geometryCalculator->sum_surface($surface1, $surface2);
            $sum_circumference = $geometryCalculator->sum_circumference($circumference1, $circumference2);

            $json = [['type' => 'circle1',
                    'radius' => floatval($radius1),
                    'surface' => $surface1,
                    'circumference' => $circumference1],
                    ['type' => 'circle2',
                    'radius' => floatval($radius2),
                    'surface' => $surface2,
                    'circumference' => $circumference2],
                    "sum_surface" => $sum_surface,
                    "sum_circumference" => $sum_circumference];
        }

        return new JsonResponse($json);
    }
}