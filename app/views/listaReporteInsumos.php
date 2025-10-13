<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Reporte de Insumos</title>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <div class="cuerpo">
        <h2>Reporte de Insumos entre fecha <?php echo($fechaIni) ?> hasta <?php echo($fechaFin) ?></h2>
        <table border="1" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>INSUMO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>STOCK</th>
                    <th>MEDIDA</th>
                    <th>PRECIO AL MOMENTO</th>
                    <th>IMPORTE TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($insumos)) {
                    foreach ($insumos as $insumo) : ?>
                        <tr class="elementos">
                            <td style="text-align: center;"><?php echo ($insumo->getCod_ins()) ?></td>
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td><?php echo ($insumo->getDscr()) ?></td>
                            <td><?php echo ($insumo->getStock()) ?></td>
                            <td><?php echo ($insumo->getUni_med()) ?></td>
                            <td><?php echo ('S/' . $insumo->getPrecio()) ?></td>
                            <td><?php echo ('S/' . $insumo->getPrecio() * $insumo->getStock()) ?></td>
                        </tr>
                <?php endforeach;
                } ?>
            </tbody>
        </table>
        <a class="create" href="registro_lista_insumos">Siguiente</a>
    </div>
</body>

</html>