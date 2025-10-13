<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Edita Insumo del Dia</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">EDITAR INSUMO DEL DIA</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_insumo_precio" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Precio Unitario" value="<?php echo ($insumo->getPrecio()); ?>" type="text" id="precio" name="precio">
                    </div>
                    <!-- <div class="input-wrapper">
                        <input class="input-field" placeholder="Precio Total" value="<?php #echo ($insumo->getPrecio_tot()); ?>" type="text" id="precio_tot" name="precio_tot">
                    </div> -->
                    <button class="create-button" type="submit" name="action" value="update">ACTUALIZAR</button>
                    <input type="hidden" value="<?php echo ($insumo->getCod_ins()); ?>" id="id" name="id" required>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
