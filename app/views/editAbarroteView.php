<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Abarrote</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Añadir Abarrote</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_abarrote" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombre Abarrote" type="text" id="nom_abarrote" name="nom_abarrote" value="<?php echo($abarrote->getNom_prod()); ?>" required>
                    </div>
                    <input type="hidden" name="cod_abarrote" value="<?php echo($abarrote->getCod_prod()); ?>">
                    <button class="create-button" type="submit" name="action" value="update">Editar Abarrote</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
