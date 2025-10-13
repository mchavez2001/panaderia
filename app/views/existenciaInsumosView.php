<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Lista de Insumos Disponibles Estimados</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="insumos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Insumos Disponibles Estimados</h2>
        <p class="subtitulo-general">Verifica tu existencia de insumos mas actuales</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>INSUMO</th>
                        <th class="hidden-mobile">DESCRIPCIÓN</th>
                        <th>STOCK</th>
                        <th class="hidden-mobile">MEDIDA</th>
                        <th>PRECIO AL MOMENTO</th>
                        <th class="hidden-mobile">IMPORTE TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo) : ?>
                        <tr class="elementos">
                            <td><?php echo ($insumo->getCod_ins()) ?></td>
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td class="hidden-mobile"><?php echo ($insumo->getDscr()) ?></td>
                            <td><?php if ($insumo->getNom_ins() == 'Anis' || $insumo->getNom_ins() == 'Escencia') {
                                    echo ($insumo->getStock() * 1000);
                                } else {
                                    echo (round($insumo->getStock(), 2));
                                } ?></td>
                            <td class="hidden-mobile"><?php echo ($insumo->getUni_med()) ?></td>
                            <td><?php echo ('S/' . $insumo->getPrecio()) ?></td>
                            <td class="hidden-mobile"><?php echo ('S/' . $insumo->getPrecio() * $insumo->getStock()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <h2 class="titulo-general">Lista de Recursos disponibles</h2>
            <p class="subtitulo-general">Verifica tu existencia de recursos</p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>RECURSO</th>
                        <th class="hidden-mobile">DESCRIPCIÓN</th>
                        <th>STOCK</th>
                        <th class="hidden-mobile">MEDIDA</th>
                        <th>PRECIO UNITARIO</th>
                        <th class="hidden-mobile">PRECIO TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #foreach ($recursos as $recurso) : 
                    ?>
                        <tr class="elementos">
                            <td><?php #echo ($insumo->getCod_ins()) 
                                ?></td>
                            <td><?php #echo ($insumo->getNom_ins()) 
                                ?></td>
                            <td class="hidden-mobile"><?php #echo ($insumo->getDscr()) 
                                                        ?></td>
                            <td><?php #echo ($insumo->getStock()) 
                                ?></td>
                            <td class="hidden-mobile"><?php #echo ($insumo->getUni_med()) 
                                                        ?></td>
                            <td><?php #echo ('S/' . $insumo->getPrecio()) 
                                ?></td>
                            <td class="hidden-mobile"><?php #echo ('S/' . $insumo->getPrecio() * $insumo->getStock()) 
                                                        ?></td>
                        </tr>
                    <?php #endforeach; 
                    ?>
                </tbody>
            </table> -->
        </div>

        <div class="mobile-cards">
            <?php foreach ($insumos as $insumo) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                        Insumo: <?php echo ($insumo->getNom_ins()) ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">description</span>
                        Descripción: <?php echo ($insumo->getDscr()) ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">store</span>
                        Stock: <?php
                                if ($insumo->getNom_ins() == 'Anis' || $insumo->getNom_ins() == 'Escencia') {
                                    echo ($insumo->getStock() * 1000) . ' gr';
                                } else {
                                    echo (round($insumo->getStock(), 2)) . ' ' . $insumo->getUni_med();
                                }
                                ?>
                    </p>
                    <!-- <p>
                        <span class="material-icons" style="color: #0869fa;">monetization_on</span>
                        Precio: S/<?php #echo ($insumo->getPrecio()) 
                                    ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">attach_money</span>
                        Importe Total: S/<?php #echo ($insumo->getPrecio() * $insumo->getStock()) 
                                            ?>
                    </p> -->
                </div>
            <?php endforeach; ?>
        </div>

        <a class="create" href="registro_lista_insumos">
            <span class="material-icons">arrow_forward</span> Siguiente
        </a>
    </div>
</body>

</html>