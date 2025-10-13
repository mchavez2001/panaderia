<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/menuPlantilla.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Menu Inventario Insumos</title>
</head>

<body>
    <?php require_once 'nav.php' ?>
    <div class="box">
        <h2>Menu Inventario de Insumos</h2>
        <a class="opcion" href="lista_insumos"><i class="fas fa-warehouse"></i> Existencia de Insumos Disponibles</a>
        <a class="opcion" href="registro_lista_insumos"><i class="fas fa-clipboard-list"></i> Registro de lista de Insumos del día</a>
        <a class="opcion" href="enviar_insumos"><i class="fas fa-truck"></i> Realizar Pedido de Insumos</a>
        <a class="opcion" href="recepcion_insumos"><i class="fas fa-boxes"></i> Recepción del Pedido</a>
    </div>
</body>

</html>
