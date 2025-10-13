<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Edita Insumo del Día</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Editar Insumo para Producción</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_insumo_produccion" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Insumo" value="<?php echo ($insumo->getStock()); ?>" type="text" id="stock" name="stock"><br><br>
                    </div>
                    <button class="create-button" type="submit" name="action" value="update">Actualizar</button>
                    <input type="hidden" value="<?php echo ($insumo->getCod_ins()); ?>" id="id" name="id" required>
                </form>
            </div>
        </div>
    </div>
</body>

</html>