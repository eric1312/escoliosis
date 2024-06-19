<!-- resources/views/patients/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Paciente</h1>
    <div class="card">
        <div class="card-header">
            {{ $patient->name }}
        </div>
        <div class="card-body">
            <p><strong>Edad:</strong> {{ $patient->age }}</p>
            <p><strong>Risser:</strong> {{ $patient->risser }}</p>
            <p><strong>Hombros Compensados:</strong> {{ $patient->shoulder_balance ? 'Sí' : 'No' }}</p>
            <h3>Curvas</h3>
            <ul>
                @foreach($patient->curves as $curve)
                    <li>
                        <strong>Tipo:</strong> {{ ucfirst($curve->curve_type) }},
                        <strong>Proximal:</strong> {{ $curve->proximal_limit }},
                        <strong>Distal:</strong> {{ $curve->distal_limit }},
                        <strong>Ángulo:</strong> {{ $curve->angle }},
                        <strong>Estructurada:</strong> {{ $curve->structured ? 'Sí' : 'No' }}
                    </li>
                @endforeach
            </ul>
            <h3>Tratamiento</h3>
            <p><strong>¿Es Quirúrgico?</strong> {{ $patient->treatment->is_surgical ? 'Sí' : 'No' }}</p>
            <p><strong>Cantidad de Tornillos:</strong> {{ $patient->treatment->screws }}</p>
        </div>
    </div>
    <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
