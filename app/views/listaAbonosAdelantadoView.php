<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista de Abonos</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>

    <a class="back" href="lista_pedidos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Abonos Adelantados</h2>
        <p class="subtitulo-general">Registra abonos adelantados para las ventas</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ABONO</th>
                        <th>METODO PAGO</th>
                        <th>FECHA DE ABONO</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($abonos as $abono) : ?>
                        <tr class="elementos">
                            <td><?php echo ($abono->getCod_abon()); ?></td>
                            <td>S/.<?php echo ($abono->getDin_abon()); ?></td>
                            <td><?php echo ($abono->getMet_pag()); ?></td>
                            <td><?php echo ($abono->getFech_abon()); ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($abono->getCod_abon()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($abono->getCod_abon()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($abonos as $abono) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">monetization_on</span>
                        Abono ID: <?php echo ($abono->getCod_abon()); ?>
                    </h3>
                    <hr />
                    <div class="card-detail">
                        <span class="material-icons">attach_money</span>
                        <p>Abono: S/.<?php echo ($abono->getDin_abon()) ?></p>
                    </div>
                    <div class="card-detail">
                        <span class="material-icons">payment</span>
                        <p><?php echo ($abono->getMet_pag()) ?></p>
                    </div>
                    <div class="card-detail">
                        <span class="material-icons">calendar_today</span>
                        Fecha Abono: <?php echo ($abono->getFech_abon()) ?>
                    </div>
                    <div class="card-actions">
                        <!-- <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($abono->getCod_abon()); ?>">
                            <span class="material-icons" style="color: #0869fa;">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php #echo ($abono->getCod_abon()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button> -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-id="<?php echo ($cod_cuenta); ?>" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Abono
        </button>
    </div>

    <script src="../public/js/abonosAdelantoView.js"></script>
</body>

</html>