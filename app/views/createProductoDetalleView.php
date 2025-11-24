<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Añadir Producto</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <h2 class="form-title">AÑADIR PRODUCTO</h2>
        <div class="form-separator"></div>
        <!-- Formulario para añadir producto -->
        <div class="user-form">
            <form action="/panaderia/public/agregar_producto_detalle" method="post">
                <div class="input-wrapper">
                    <label for="nombre">Nombre del Producto:</label>
                    <select name="nombre" id="nombre" class="select-field">
                        <option value="">Selecciona un producto...</option>
                        <option value="Pan">Pan</option>
                        <option value="Bizcocho">Bizcocho</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <label for="tamano">Tamaño:</label>
                    <select name="tamano" id="tamano" class="select-field">
                        <option value="Pequeño">Pequeño</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="cant">Cantidad Unidades:</label>
                    <input type="number" min="0" id="cant" name="cant" class="input-field">
                </div>
                <input type="hidden" id="cod_prod" name="cod_prod" value="<?php echo ($cod_prod); ?>">
                <input type="hidden" name="id_venta" value="<?php echo ($cod_venta); ?>">
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="guardar">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>