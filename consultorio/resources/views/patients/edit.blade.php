<!-- resources/views/patients/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Paciente</h1>
    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $patient->name }}" required>
        </div>
        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" class="form-control" id="age" name="age" value="{{ $patient->age }}" required>
        </div>
        <div class="form-group">
            <label for="risser">Risser</label>
            <input type="number" class="form-control" id="risser" name="risser" value="{{ $patient->risser }}" required>
        </div>
        <div class="form-group">
            <label for="shoulder_balance">Hombros Compensados</label>
            <select class="form-control" id="shoulder_balance" name="shoulder_balance" required>
                <option value="1" {{ $patient->shoulder_balance ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$patient->shoulder_balance ? 'selected' : '' }}>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
