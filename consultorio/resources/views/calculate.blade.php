<!DOCTYPE html>
<html>
<head>
    <title>Calcular Ángulo</title>
    <script src="https://cdn.jsdelivr.net/npm/konva@8.3.10/konva.min.js"></script>
</head>
<body>
    <h1>Calcular Ángulo</h1>
    <div id="container"></div>
    <button id="calculateButton">Calcular Ángulo</button>
    <p id="result"></p>

    <script>
        var stage = new Konva.Stage({
            container: 'container',
            width: window.innerWidth,
            height: window.innerHeight
        });

        var layer = new Konva.Layer();
        stage.add(layer);

        var points = [];

        stage.on('click', function (e) {
            var pos = stage.getPointerPosition();
            points.push({ x: pos.x, y: pos.y });

            var circle = new Konva.Circle({
                x: pos.x,
                y: pos.y,
                radius: 5,
                fill: 'red'
            });

            layer.add(circle);
            layer.draw();

            if (points.length === 4) {
                var line1 = new Konva.Line({
                    points: [points[0].x, points[0].y, points[1].x, points[1].y],
                    stroke: 'blue',
                    strokeWidth: 2
                });

                var line2 = new Konva.Line({
                    points: [points[2].x, points[2].y, points[3].x, points[3].y],
                    stroke: 'blue',
                    strokeWidth: 2
                });

                layer.add(line1);
                layer.add(line2);
                layer.draw();
            }
        });

        document.getElementById('calculateButton').addEventListener('click', function () {
            if (points.length < 4) {
                alert('Por favor, dibuja dos líneas (4 puntos).');
                return;
            }

            fetch('/calculate-angle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ points: points })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').textContent = 'Ángulo: ' + data.angle + ' grados';
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
