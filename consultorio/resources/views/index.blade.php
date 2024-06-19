<!-- resources/views/patients/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pacientes</h1>
    <a href="{{ route('patients.create') }}" class="btn btn-primary">Agregar Paciente</a>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Risser</th>
                <th>Hombros Compensados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->age }}</td>
                    <td>{{ $patient->risser }}</td>
                    <td>{{ $patient->shoulder_balance ? 'Sí' : 'No' }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
