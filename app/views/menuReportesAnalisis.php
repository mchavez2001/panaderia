<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/menuPlantilla.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Menu de Reportes y Analisis</title>
</head>

<body>
    <?php require_once 'nav.php' ?>
    <div class="box">
        <h2>Menu de Reportes y Analisis</h2>
        <a class="opcion" href="reporte_inventario_insumos">
            <span class="material-icons">inventory_2</span>
            Reporte de Inventario de Insumos
        </a>
        <a class="opcion" href="reporte_producciones">
            <span class="material-icons">fact_check</span>
            Reporte de Producciones
        </a>
        <a class="opcion" href="reporte_inventario_productos">
            <span class="material-icons">inventory</span>
            Reporte de Inventario de Productos
        </a>
        <a class="opcion" href="reporte_ventas">
            <span class="material-icons">assessment</span>
            Reporte de Ventas
        </a>
    </div>
</body>

</html>
