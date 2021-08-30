<?php

namespace App\Controller;

use App\Service\GeometryCalculator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TriangleController
{
    /**
     * @Route("/triangle/{a1}/{b1}/{c1}/{a2}/{b2}/{c2}", defaults={"a2"=0, "b2"=0, "c2"=0})
     */
    public function triangle($a1, $b1, $c1, $a2, $b2, $c2)
    {
        $geometryCalculator = new GeometryCalculator();

        $surface1 = $geometryCalculator->triangle_surface($a1, $b1, $c1);
        $circumference1 = $geometryCalculator->triangle_circumference($a1, $b1, $c1);

        $json = ['type' => 'triangle1',
                'a' => floatval($a1),
                'b' => floatval($b1),
                'c' => floatval($c1),
                'surface' => $surface1,
                'circumference' => $circumference1];

        if ($a2 != 0 || $b2 != 0 || $c2 != 0) {
            $surface2 = $geometryCalculator->triangle_surface($a2, $b2, $c2);
            $circumference2 = $geometryCalculator->triangle_circumference($a2, $b2, $c2);
            $sum_surface = $geometryCalculator->sum_surface($surface1, $surface2);
            $sum_circumference = $geometryCalculator->sum_circumference($circumference1, $circumference2);

            $json = [['type' => 'triangle1',
                    'a' => floatval($a1),
                    'b' => floatval($b1),
                    'c' => floatval($c1),
                    'surface' => $surface1,
                    'circumference' => $circumference1],
                    ['type' => 'triangle2',
                    'a' => floatval($a2),
                    'b' => floatval($b2),
                    'c' => floatval($c2),
                    'surface' => $surface2,
                    'circumference' => $circumference2],
                    "sum_surface" => $sum_surface,
                    "sum_circumference" => $sum_circumference];
        }

        return new JsonResponse($json);
    }



}