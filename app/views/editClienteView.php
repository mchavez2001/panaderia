<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Editar Cliente</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Editar Cliente</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_cliente" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="DNI Cliente" type="text" id="dni" name="dni" value="<?php echo $cliente->getDni(); ?>">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombre Cliente" type="text" id="nom_cliente" name="nom_cliente" value="<?php echo $cliente->getNom_cliente(); ?>">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Apellidos Cliente" type="text" id="apell_cliente" name="apell_cliente" value="<?php echo $cliente->getApell_cliente(); ?>">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Teléfono" type="text" id="telef" name="telef" value="<?php echo $cliente->getTelef(); ?>">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Dirección" type="text" id="direccion" name="direccion" value="<?php echo $cliente->getDireccion(); ?>">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Sector" type="text" id="sector" name="sector" value="<?php echo $cliente->getSector(); ?>">
                    </div>

                    <input type="hidden" id="cod_cliente" name="cod_cliente" value="<?php echo $cliente->getId_cliente(); ?>">
                    <button class="create-button" type="submit" name="action" value="update">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
