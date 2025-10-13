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
        <h2 class="form-title">AÑADIR PRODUCTO PARA PRODUCCIÓN</h2> <!-- Usar clase para el título -->
        <div class="form-separator"></div> <!-- Usar clase para la línea decorativa -->
        <div class="user-form"> <!-- Cambiar a la clase del formulario -->
            <form action="/panaderia/public/agregar_produccion" method="post">
                <div class="input-wrapper"> <!-- Contenedor para inputs -->
                    <label for="nombre">Nombre del Producto:</label>
                    <select name="nombre" id="nombre" class="select-field" onchange="actualizarTamanos()">
                        <option value="Pan">Pan</option>
                        <option value="Bizcocho">Bizcocho</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <input placeholder="Descripción" type="text" id="desc" name="desc" class="input-field">
                </div>
                <div class="input-wrapper">
                    <label for="tamano">Tamaño:</label>
                    <select name="tamano" id="tamano" class="select-field">
                        <option value="Grande">Grande</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Pequeño">Pequeño</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <input placeholder="Cantidad a producir" type="text" id="cant" name="cant" class="input-field">
                </div>
                <div class="input-wrapper">
                    <label for="uni_med">Medida:</label>
                    <select name="uni_med" id="uni_med" class="select-field">
                        <option value="bolsas">bolsas</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <label for="extraExist">¿Agregar Unidades Adicionales?
                        <input class="check" type="checkbox" name="extraExist" id="extraExist">
                    </label>
                </div>
                <div class="input-wrapper">
                    <input placeholder="Cantidad de unidades" type="text" id="extra" name="extra" class="input-field">
                </div>
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="guardar">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../public/js/createProduccionView.js"></script>
</body>

</html>
