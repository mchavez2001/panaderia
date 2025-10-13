<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista De Consumos de Petroleo</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Consumos de Petroleo</h2>
        <p class="subtitulo-general">Registra los consumos diarios de petroleo</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FECHA</th>
                        <th>ALTURA INICIAL</th>
                        <th>ALTURA FINAL</th>
                        <th>VARIACIÓN</th>
                        <th>GALONES</th>
                        <th>INVERSION</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consumos as $consumo) : ?>
                        <tr class="elementos">
                            <td><?php echo ($consumo->getCod_consumo_petroleo()) ?></td>
                            <td><?php echo ($consumo->getFecha()) ?></td>
                            <td><?php echo ($consumo->getAltura_inicial()) ?></td>
                            <td><?php echo ($consumo->getAltura_final()) ?></td>
                            <td><?php echo ($consumo->getVariante()) ?></td>
                            <td><?php echo ($consumo->getGalones()) ?></td>
                            <td><?php echo ($consumo->getInversion()) ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($consumo->getCod_consumo_petroleo()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($consumo->getCod_consumo_petroleo()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($consumos as $consumo) : ?>
                <div class="card">
                    <h3 class="card-title"><span class="material-icons" style="color: #0869fa;">tag</span>ID: <?php echo ($consumo->getCod_consumo_petroleo()); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">calendar_today</span>
                        Fecha: <?php echo ($consumo->getFecha()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">straighten</span>
                        Altura Inicial: <?php echo ($consumo->getAltura_inicial()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">straighten</span>
                        Altura Final: <?php echo ($consumo->getAltura_final()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">straighten</span>
                        Variacion: <?php echo ($consumo->getVariante()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">local_gas_station</span>
                        Galones: <?php echo ($consumo->getGalones()); ?> galones
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">attach_money</span>
                        Inversion: <?php echo ('S/.'.$consumo->getInversion()); ?>
                    </p>
                    <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($consumo->getCod_consumo_petroleo()); ?>">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($consumo->getCod_consumo_petroleo()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                        <!-- <button type="button" class="calcular" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($consumo->getCod_consumo_petroleo()); ?>">
                            <i class="fas fa-calculator"></i>
                        </button> -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Consumo
        </button>
    </div>

    <script src="../public/js/petroleoView.js"></script>
</body>

</html>