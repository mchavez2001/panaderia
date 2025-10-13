<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista de Entregas</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="producto_venta_seguimiento?id=<?php echo ($cod_venta); ?>">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Entregas</h2>
        <p class="subtitulo-general">Registra todas las entregas del producto</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>BOLSAS ENTREGADAS</th>
                        <th>FECHA DE ENTREGA</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($entregas as $entrega) : ?>
                        <tr class="elementos">
                            <td><?php echo ($entrega->getCod_entr()); ?></td>
                            <td><?php echo ($entrega->getCant_entr()); ?></td>
                            <td><?php echo ($entrega->getFech_entr()); ?></td>
                            <td>
                                <form action="/panaderia/public/editar_entrega" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($entrega->getCod_entr()); ?>">
                                    <button type="submit" value="editar">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form action="/panaderia/public/eliminar_entrega" method="post">
                                    <input type="hidden" name="id" value="<?php echo ($entrega->getCod_entr()); ?>">
                                    <button type="submit" name="action" value="eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="mobile-cards">
            <?php foreach ($entregas as $entrega) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">assignment</span>
                        Entrega ID: <?php echo ($entrega->getCod_entr()); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">assignment_turned_in</span>
                        Bolsas Entregadas: <?php echo ($entrega->getCant_entr()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">event</span>
                        Fecha de Entrega: <?php echo ($entrega->getFech_entr()); ?>
                    </p>
                    <div class="card-actions">
                        <form action="/panaderia/public/editar_entrega" method="get" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo ($entrega->getCod_entr()); ?>">
                            <button type="submit" class="edit">
                                <span class="material-icons">edit</span>
                            </button>
                        </form>
                        <form action="/panaderia/public/eliminar_entrega" method="post" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo ($entrega->getCod_entr()); ?>">
                            <button type="submit" class="btn-delete" style="background: none; border: none; cursor: pointer;">
                                <span class="material-icons" style="color: red;">delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button type="button" class="create" data-id="<?php echo ($cod_prod); ?>" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Entrega
        </button>
    </div>
    
    <script src="../public/js/entregasView.js"></script>
</body>

</html>
