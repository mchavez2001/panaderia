<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Añadir Entrega</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <h2 class="form-title">AÑADIR ENTREGA</h2>
        <div class="form-separator"></div>
        <div class="user-form">
            <form action="/panaderia/public/agregar_entrega" method="post">
                <div class="input-wrapper">
                    <input placeholder="Cantidad de bolsas" type="number" id="cant" name="cant" class="input-field">
                </div>
                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="add">AÑADIR</button>
                </div>
                <input placeholder="id" value="<?php echo($cod_prod) ?>" type="hidden" id="id" name="id" required>
            </form>
        </div>
    </div>
</body>

</html>
