<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store(Request $request)
    {
        $patient = Patient::create($request->all());

        foreach ($request->curves as $curveData) {
            $curve = new Curve($curveData);
            $patient->curves()->save($curve);
        }

        $treatment = $this->determineTreatment($patient);
        $patient->treatment()->save($treatment);

        return redirect()->route('patients.show', $patient);
    }

    protected function determineTreatment(Patient $patient)
    {
        $is_surgical = false;
        $screws = 0;

        foreach ($patient->curves as $curve) {
            if ($curve->angle > 50 || ($curve->angle >= 40 && $curve->angle <= 50 && $patient->risser < 5)) {
                $is_surgical = true;
                $screws += ($this->calculateVertebrae($curve->proximal_limit, $curve->distal_limit) + 1) * 2;
            }
        }

        if ($patient->shoulder_balance == false) {
            $is_surgical = true;
            // Add screws for T4
            $screws += 2;
        }

        return new Treatment(['is_surgical' => $is_surgical, 'screws' => $screws]);
    }

    protected function calculateVertebrae($proximal, $distal)
    {
        // Assuming the vertebrae are ordered in a specific way
        $vertebrae = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12', 'L1', 'L2', 'L3', 'L4', 'L5'];
        return array_search($distal, $vertebrae) - array_search($proximal, $vertebrae);
    }   
}

