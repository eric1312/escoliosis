<!-- resources/views/patients/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Paciente</h1>
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="age">Edad</label>
            <input type="number" class="form-control" id="age" name="age" required>
        </div>
        <div class="form-group">
            <label for="risser">Risser</label>
            <input type="number" class="form-control" id="risser" name="risser" required>
        </div>
        <div class="form-group">
            <label for="shoulder_balance">Hombros Compensados</label>
            <select class="form-control" id="shoulder_balance" name="shoulder_balance" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
