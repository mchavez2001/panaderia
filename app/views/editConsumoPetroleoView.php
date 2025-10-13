<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Editar Consumo Petroleo</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <h2 class="form-title">EDITAR CONSUMO PETROLEO</h2>
        <div class="form-separator"></div>
        <div class="user-form">
            <form action="/panaderia/public/editar_consumo_petroleo" method="post">
                <div class="input-wrapper">
                    <input placeholder="Ingresa la altura inicial" type="number" step="0.01" min="0" value="<?php echo ($consumo->getAltura_inicial()); ?>" id="altura_inicial" name="altura_inicial" class="input-field">
                </div>
                <div class="input-wrapper">
                    <input placeholder="Ingresa la altura final" type="number" step="0.01" min="0" value="<?php echo ($consumo->getAltura_final());?>" id="altura_final" name="altura_final" class="input-field">
                </div>
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="edit">ACTUALIZAR</button>
                </div>
                <input type="hidden" value="<?php echo ($consumo->getCod_consumo_petroleo()); ?>" id="id" name="id">
            </form>
        </div>
    </div>
</body>

</html>