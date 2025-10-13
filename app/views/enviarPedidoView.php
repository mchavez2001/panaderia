<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Enviar Insumos</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="insumos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Insumos Para Enviar</h2>
        <p class="subtitulo-general">Verifica y realiza el envio de tus insumos</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>INSUMO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CANTIDAD</th>
                        <th>MEDIDA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo) : ?>
                        <tr class="elementos">
                            <td><?php echo ($insumo->getCod_ins()) ?></td>
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td><?php echo ($insumo->getDscr()) ?></td>
                            <td><?php echo ($insumo->getBloque()) ?></td>
                            <td><?php echo ($insumo->getUni_bloque()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($insumos as $insumo) : ?>
                <div class="card">
                    <h3 class="card-title">Insumo ID: <?php echo ($insumo->getCod_ins()) ?></h3>
                    <p>
                        <strong>Nombre:</strong> <?php echo ($insumo->getNom_ins()) ?><br>
                        <strong>Descripción:</strong> <?php echo ($insumo->getDscr()) ?><br>
                        <strong>Cantidad:</strong> <?php echo ($insumo->getBloque()) ?><br>
                        <strong>Medida:</strong> <?php echo ($insumo->getUni_bloque()) ?><br>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <a class="create" href="generarPDF">Realizar Envio</a>
    </div>
</body>

</html>
