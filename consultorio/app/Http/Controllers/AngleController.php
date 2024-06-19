<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AngleController extends Controller
{
    /**
     * Calcula el ángulo entre dos líneas definidas por puntos.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function calculateAngle(Request $request)
    {
        // Validar los puntos recibidos
        $request->validate([
            'points' => 'required|array',
            'points.*.x' => 'required|numeric',
            'points.*.y' => 'required|numeric',
        ]);

        $points = $request->input('points');

        // Asegurarse de que hay suficientes puntos
        if (count($points) < 4) {
            return response()->json(['error' => 'Se requieren al menos 4 puntos.'], 400);
        }

        // Obtener los puntos
        $x1 = $points[0]['x'];
        $y1 = $points[0]['y'];
        $x2 = $points[1]['x'];
        $y2 = $points[1]['y'];
        $x3 = $points[2]['x'];
        $y3 = $points[2]['y'];
        $x4 = $points[3]['x'];
        $y4 = $points[3]['y'];

        // Calcular los vectores de las líneas
        $vector1 = [$x2 - $x1, $y2 - $y1];
        $vector2 = [$x4 - $x3, $y4 - $y3];

        // Calcular el producto punto y las magnitudes
        $dotProduct = $vector1[0] * $vector2[0] + $vector1[1] * $vector2[1];
        $magnitude1 = sqrt(pow($vector1[0], 2) + pow($vector1[1], 2));
        $magnitude2 = sqrt(pow($vector2[0], 2) + pow($vector2[1], 2));

        // Calcular el ángulo en radianes y convertir a grados
        $angleRad = acos($dotProduct / ($magnitude1 * $magnitude2));
        $angleDeg = rad2deg($angleRad);

        return response()->json(['angle' => $angleDeg]);
    }
}

