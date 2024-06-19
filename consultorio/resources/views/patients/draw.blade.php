<!-- resources/views/patients/draw.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dibujar Curvas</h1>
    <div id="container"></div>
    <form id="curvesForm" action="{{ route('curves.store') }}" method="POST">
        @csrf
        <input type="hidden" id="curvesData" name="curvesData">
        <button type="submit" class="btn btn-primary">Guardar Curvas</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var width = window.innerWidth;
        var height = 500;

        var stage = new Konva.Stage({
            container: 'container',
            width: width,
            height: height
        });

        var layer = new Konva.Layer();
        stage.add(layer);

        var lines = [];
        var currentLine;

        stage.on('mousedown touchstart', function() {
            currentLine = new Konva.Line({
                stroke: 'red',
                strokeWidth: 2,
                lineCap: 'round',
                lineJoin: 'round',
                points: []
            });
            layer.add(currentLine);
            lines.push(currentLine);
        });

        stage.on('mousemove touchmove', function() {
            if (!currentLine) {
                return;
            }
            var pos = stage.getPointerPosition();
            var newPoints = currentLine.points().concat([pos.x, pos.y]);
            currentLine.points(newPoints);
            layer.batchDraw();
        });

        stage.on('mouseup touchend', function() {
            currentLine = null;
        });

        document.getElementById('curvesForm').addEventListener('submit', function(e) {
            var curvesData = lines.map(function(line) {
                return line.points();
            });
            document.getElementById('curvesData').value = JSON.stringify(curvesData);
        });
    });
</script>
@endsection
