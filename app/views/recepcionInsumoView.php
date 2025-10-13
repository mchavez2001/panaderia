<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Recepcion del Pedido</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="insumos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Recepcion del Pedido</h2>
        <p class="subtitulo-general">Verifica tus insumos y registra las cantidades correctas</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>INSUMO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CANTIDAD EN BLOQUE</th>
                        <th>MEDIDA</th>
                        <th>UNIDADES</th>
                        <th>MEDIDA</th>
                        <th>PESO INDIVIDUAL</th>
                        <th>STOCK</th>
                        <th>MEDIDA</th>
                        <th>COSTO UNITARIO</th>
                        <th>COSTO TOTAL</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($insumos as $insumo) : ?>
                        <tr class="elementos">
                            <td><?php echo ($insumo->getCod_ins()) ?></td>
                            <td><?php echo ($insumo->getNom_ins()) ?></td>
                            <td><?php echo ($insumo->getDscr()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getBloque()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getUni_bloque()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getPack()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getUni_pack()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getPeso_ind()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getStock()) ?></td>
                            <td style="text-align: center;"><?php echo ($insumo->getUni_med()) ?></td>
                            <td style="text-align: center;">
                                <?php 
                                if(empty($insumo->getPrecio())) {
                                    echo ('Sin Asignar');
                                } else {
                                    echo ('S/' . $insumo->getPrecio());
                                }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <?php
                                if(empty($insumo->getPrecio())) {
                                    echo ('S/.0');
                                } else {
                                    if(empty($insumo->getPack())) {
                                        echo ('S/' . $insumo->getPrecio() * $insumo->getBloque());
                                    } else {
                                        echo ('S/' . $insumo->getPrecio() * $insumo->getPack() * $insumo->getBloque());
                                    }
                                }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="editkgprecio" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumo->getCod_ins()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
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
                        <strong>Cantidad en Bloque:</strong> <?php echo ($insumo->getBloque()) ?><br>
                        <strong>Medida:</strong> <?php echo ($insumo->getUni_bloque()) ?><br>
                        <strong>Unidades:</strong> <?php echo ($insumo->getPack()) ?><br>
                        <strong>Peso Individual:</strong> <?php echo ($insumo->getPeso_ind()) ?><br>
                        <strong>Stock:</strong> <?php echo ($insumo->getStock()) ?><br>
                        <strong>Costo Unitario:</strong> <?php 
                        if(empty($insumo->getPrecio())) {
                            echo ('Sin Asignar');
                        } else {
                            echo ('S/' . $insumo->getPrecio());
                        }
                        ?><br>
                        <strong>Costo Total:</strong> <?php
                        if(empty($insumo->getPrecio())) {
                            echo ('S/.0');
                        } else {
                            if(empty($insumo->getPack())) {
                                echo ('S/' . $insumo->getPrecio() * $insumo->getBloque());
                            } else {
                                echo ('S/' . $insumo->getPrecio() * $insumo->getPack() * $insumo->getBloque());
                            }
                        }
                        ?><br>
                    </p>
                    <button type="button" class="editkgprecio" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($insumo->getCod_ins()); ?>">
                        <span class="material-icons" style="color: #0869fa;">edit</span>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

        <a class="create" href="guardar_inv_insumo">Guardar Inventario del Dia</a>
    </div>
    <script src="../public/js/registrarInsumosView.js"></script>
</body>

</html>
