<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Lista De Productos a Producir</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de productos a producir</h2>
        <p class="subtitulo-general">Verifica y realiza el calculo de las producciones en insumos</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>TAMAÑO</th>
                        <th>CANTIDAD</th>
                        <th>UNIDAD</th>
                        <th>ADICIONAL</th>
                        <th>UNIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="elementos">
                            <td><?php echo htmlspecialchars($producto->getCod_prod(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($producto->getNom_prod(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($producto->getDscr_prod(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($producto->getTam_prod(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center"><?php echo htmlspecialchars($producto->getCant_prod(), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">BOLSAS</td>
                            <td class="text-center"><?php echo htmlspecialchars($producto->getCant_extra() ?? 0, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-center">UNIDADES</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($productos as $producto) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                        Producto ID: <?php echo htmlspecialchars($producto->getCod_prod(), ENT_QUOTES, 'UTF-8'); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">text_snippet</span>
                        Producto: <?php echo htmlspecialchars($producto->getNom_prod(), ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">format_size</span>
                        Tamaño: <?php echo htmlspecialchars($producto->getTam_prod(), ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">check_circle</span>
                        Cantidad: <?php echo htmlspecialchars($producto->getCant_prod(), ENT_QUOTES, 'UTF-8'); ?> Bolsas
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">add_circle</span>
                        Adicional: <?php echo htmlspecialchars($producto->getCant_extra() ?? 0, ENT_QUOTES, 'UTF-8'); ?> Unidades
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <a class="create" href="insumos_calculados">
            <span class="material-icons" style="color: white;">calculate</span>Calcular Insumos Requeridos
        </a>
    </div>
</body>

</html>