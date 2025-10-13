<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al Sistema</title>
    <link rel="stylesheet" href="/panaderia/public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="box">
            <h2>Iniciar Sesión</h2>
            <div class="line"></div>
            <form action="/panaderia/public/login" method="post" class="formulario">
                <input placeholder="Usuario" type="text" id="username" name="username" required>
                <input placeholder="Clave" type="password" id="password" name="password" required>
                <button type="submit">Ingresar</button>
            </form>
        </div>
    </div>
</body>

</html>