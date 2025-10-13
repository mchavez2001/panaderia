<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css"> <!-- Cambia a tu hoja de estilos general -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Crear Producción</title>
</head>

<body class="bodyForm"> <!-- Aplicar la clase del cuerpo de la hoja de estilos -->
    <div class="modal-content"> <!-- Cambiar a la clase de contenedor principal -->
        <h2 class="form-title">AÑADIR COCHE PARA PRODUCCIÓN</h2> <!-- Usar clase para el título -->
        <div class="form-separator"></div> <!-- Usar clase para la línea decorativa -->
        <div class="user-form"> <!-- Cambiar a la clase del formulario -->
            <form action="/panaderia/public/agregar_coche" method="post">
                <div class="input-wrapper"> <!-- Contenedor para inputs -->
                    <label for="nombre">Nombre del Producto:</label>
                    <select name="nombre" id="nombre" class="select-field">
                        <option value="Pan">Pan</option>
                        <option value="Bizcocho">Bizcocho</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <input placeholder="Cantidad de coches" type="number" step="any" id="coches" name="coches" min=0 class="input-field">
                </div>
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="guardar">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>