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
            <h2 class="form-title">Añadir Detalle de Pago</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/agregar_pago_detalle" method="post">
                    <div class="input-wrapper">
                        <label for="detalle_pago">Pago</label>
                        <select class="select-field" name="nombre" id="nombre" style="width: 100%;">
                            <option value="PASAJE">PASAJE</option>
                            <option value="EMBALAJE">EMBALAJE</option>
                        </select><br>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Descripcion" type="text" id="dscr" name="dscr">
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