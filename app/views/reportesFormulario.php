<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Reporte</title>
</head>

<body>
    <?php require_once 'nav.php' ?>
    <form action="<?php echo($action) ?>" method="post" style="text-align: center; margin-top: 20px;">
    <label for="">Cliente</label>
    <input type="text">
        <input type="date" name="fchini" id="">
        <input type="date" name="fchfin" id="">
        <button class="crear" type="submit" name="action" value="enviar">Buscar</button>
    </form>
</body>

</html>