<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curve;
use App\Models\Patient;

class CurveController extends Controller
{
    public function draw()
    {
        return view('patients.draw');
    }

    public function store(Request $request)
    {
        $curvesData = json_decode($request->input('curvesData'), true);

        // Aquí puedes procesar y guardar las curvas en la base de datos
        // Suponiendo que tienes el ID del paciente al que pertenecen las curvas

        $patientId = 1; // Ejemplo, en realidad deberías obtener esto del formulario o la sesión
        foreach ($curvesData as $curveData) {
            Curve::create([
                'patient_id' => $patientId,
                'curve_type' => 'primary', // o 'secondary', 'tertiary', según sea el caso
                'proximal_limit' => 'T1', // Deberías calcular esto basado en los puntos
                'distal_limit' => 'L5', // Deberías calcular esto basado en los puntos
                'angle' => $this->calculateAngle($curveData),
                'structured' => false // Determina esto según tus reglas
            ]);
        }

        return redirect()->route('patients.show', $patientId);
    }

    private function calculateAngle($points)
    {
        // Implementa tu lógica para calcular el ángulo basado en los puntos
        return 0; // Placeholder, reemplaza con la lógica real
    }
}
