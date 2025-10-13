<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista De Insumos Requeridos</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Insumos Requeridos Aproximadamente</h2>
        <p class="subtitulo-general">Verifica y confirma los insumos calculados actualizar tu stock de insumos</p>
        <?php for ($i = 0; $i < count($producciones); $i++) : ?>
            <div class="produccion">
                <h3>
                    <?php if (!empty($producciones[$i]->getCant_extra())) {
                        echo ('ID de Producción ' . $producciones[$i]->getCod_prod() . ': Cantidad de ' . $producciones[$i]->getNom_prod() . ' ' . $producciones[$i]->getTam_prod() . ' = ' . $producciones[$i]->getCant_prod() . ' Bolsas + ' . $producciones[$i]->getCant_extra() . ' Unidades');
                    } else {
                        echo ('ID de Producción ' . $producciones[$i]->getCod_prod() . ': Cantidad de ' . $producciones[$i]->getNom_prod() . ' ' . $producciones[$i]->getTam_prod() . ' = ' . $producciones[$i]->getCant_prod() . ' Bolsas');
                    } ?>
                </h3>

                <div class="table-container desktop-view">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>INSUMO</th>
                                <th>STOCK</th>
                                <th>MEDIDA</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($j = 0; $j < count($insumos); $j++) {
                                if ($producciones[$i]->getCod_prod() == $insumos[$j]->getBloque()) { ?>
                                    <tr class="elementos">
                                        <td style="text-align: center;"><?php echo ($insumos[$j]->getCod_ins()) ?></td>
                                        <td><?php echo ($insumos[$j]->getNom_ins()) ?></td>
                                        <td><?php echo ($insumos[$j]->getStock()) ?></td>
                                        <td><?php echo ($insumos[$j]->getUni_med()) ?></td>
                                        <td style="text-align: center;">
                                            <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumos[$j]->getCod_ins()); ?>">
                                                <span class="material-icons" style="color: #0869fa;">edit</span>
                                            </button>
                                        </td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn-delete" data-id="<?php echo ($insumos[$j]->getCod_ins()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                                <span class="material-icons" style="color: red;">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>

                <div class="mobile-cards">
                    <?php for ($j = 0; $j < count($insumos); $j++) {
                        if ($producciones[$i]->getCod_prod() == $insumos[$j]->getBloque()) { ?>
                            <div class="card">
                                <h4 class="card-title">
                                    <span class="material-icons" style="color: #0869fa;">inventory</span>
                                    Insumo ID: <?php echo htmlspecialchars($insumos[$j]->getCod_ins(), ENT_QUOTES, 'UTF-8'); ?>
                                </h4>
                                <hr />
                                <p>
                                    <span class="material-icons" style="color: #0869fa;">text_snippet</span>
                                    Insumo: <?php echo htmlspecialchars($insumos[$j]->getNom_ins(), ENT_QUOTES, 'UTF-8'); ?>
                                </p>
                                <p>
                                    <span class="material-icons" style="color: #0869fa;">check_circle</span>
                                    Stock: <?php echo htmlspecialchars($insumos[$j]->getStock(), ENT_QUOTES, 'UTF-8'); ?>
                                </p>
                                <p>
                                    <span class="material-icons" style="color: #0869fa;">straighten</span>
                                    Medida: <?php echo htmlspecialchars($insumos[$j]->getUni_med(), ENT_QUOTES, 'UTF-8'); ?>
                                </p>
                                <div class="card-actions">
                                    <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumos[$j]->getCod_ins()); ?>">
                                        <span class="material-icons" style="color: #0869fa;">edit</span>
                                    </button>
                                    <button type="button" class="btn-delete" data-id="<?php echo ($insumos[$j]->getCod_ins()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                        <span class="material-icons" style="color: red;">delete</span>
                                    </button>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        <?php endfor; ?>

        <a class="create" href="descuento_insumos_produccion">
            <span class="material-icons" style="color: white;">check_circle</span>Confirmar Insumos En Producción
        </a>
    </div>

    <script src="../public/js/insumosCalculados.js"></script>
</body>

</html>
