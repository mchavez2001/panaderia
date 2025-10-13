<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Añadir Abono</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <h2 class="form-title">AÑADIR ABONO</h2>
        <div class="form-separator"></div>
        <div class="user-form">
            <form action="/panaderia/public/editar_abono" method="post">
                <div class="input-wrapper">
                    <input placeholder="Monto S/." type="text" id="monto" name="monto" class="input-field" value="<?php echo($abono->getDin_abon()); ?>">
                </div>
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="update">ACTUALIZAR</button>
                </div>
                <input placeholder="id" value="<?php echo($abono->getCod_abon()) ?>" type="hidden" id="cod_abon" name="cod_abon" required>
                <input placeholder="id" value="<?php echo($cod_cuenta) ?>" type="hidden" id="cod_venta" name="cod_venta" required>
            </form>
        </div>
    </div>
</body>

</html>
