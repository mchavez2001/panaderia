<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="cuerpo">
        <h2 style="text-align: center;">Lista De Insumos Requeridos Aproximadamente</h2>
        <!-- <div class="table-container"> -->
            <table>
                <thead>
                    <tr>
                        <th>INSUMO</th>
                        <th>CANTIDAD</th>
                        <th>MEDIDA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo) { ?>
                        <tr class="elementos">
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td><?php echo ($insumo->getStock()) ?></td>
                            <td><?php echo ($insumo->getUni_med()) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <!-- </div> -->
    </div>
</body>