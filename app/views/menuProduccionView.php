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
    <title>Menu Producción</title>
</head>

<body>
    <?php require_once 'nav.php' ?>
    <div class="box">
        <h2>Menu Producción</h2>
        <a class="opcion" href="coches_produccion"><i class="fas fa-box"></i> Lista de Coches a Producir</a>
        <!-- <a class="opcion" href="productos_produccion"><i class="fas fa-box"></i> Lista de Productos a Producir</a> -->
        <a class="opcion" href="calcular_produccion_base_productos"><i class="fas fa-calculator"></i> Generar y Calcular Producción (En Base a Productos)</a>
        <a class="opcion" href="distribucion_insumos"><i class="fas fa-chart-pie"></i> Distribución de Insumos y Cantidades</a>
        <a class="opcion" href="merma_produccion"><i class="fas fa-box"></i> Registrar Merma </a>
        <a class="opcion" href="consumo_petroleo"><i class="fas fa-gas-pump"></i> Consumo Petroleo</a>
    </div>
</body>

</html>
