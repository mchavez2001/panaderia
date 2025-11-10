<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Detalle de ago</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Añadir Detalle de Producto</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/agregar_pago_detalle_producto" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombre Producto" type="text" id="nombre" name="nombre">
                    </div>
                    <div class="input-wrapper">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" step="any" id="cantidad" name="cantidad" class="input-field">
                    </div>
                    <div class="input-wrapper">
                        <label for="monto">Monto</label>
                        <input type="number" step="any" id="monto" name="monto" class="input-field">
                    </div>
                    <input type="hidden" id="cod_pago" name="cod_pago" value="<?php echo ($cod_pago); ?>">
                    <button class="create-button" type="submit" name="action" value="guardar">Añadir Detalle de Pago</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>