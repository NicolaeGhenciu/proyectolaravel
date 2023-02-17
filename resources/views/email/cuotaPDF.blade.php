<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>🏗️ SIEMPRECOLGADOS S.A</h3>
    <hr>
    <p>Estimado <i>{{ $empleado->nombre_y_apellidos }}</i>,</p>
    <p>Adjunto le enviamos la {{ $asunto }}</p>
    <p>Un cordial saludo,</p>
    <hr>
    <p>Administrador</p>
</body>

</html>
