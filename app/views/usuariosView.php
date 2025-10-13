<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Gestión de Usuarios</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="usuarios">Volver</a>
    <div class="cuerpo" style="margin-bottom: 20px;">
        <h2 class="titulo-general">Lista de usuarios</h2>
        <p class="subtitulo-general">Administra los usuarios</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDO</th>
                        <th>ROL</th>
                        <th>ESTADO</th>
                        <th>CORREO</th>
                        <th class="hidden-mobile">EDITAR</th>
                        <th class="hidden-mobile">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr class="elementos">
                            <td><?php echo ($usuario->getId_empleado()); ?></td>
                            <td><?php echo ($usuario->getUser()); ?></td>
                            <td><?php echo ($usuario->getNombre()); ?></td>
                            <td><?php echo ($usuario->getApellido()); ?></td>
                            <td><?php echo ($usuario->getRol()); ?></td>
                            <td><?php echo ($usuario->getEstado()); ?></td>
                            <td>
                                <?php
                                if ($usuario->getEmail() == '') {
                                    echo ('No hay data');
                                } else {
                                    echo ($usuario->getEmail());
                                }
                                ?>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($usuario->getId_empleado()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($usuario->getId_empleado()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($usuarios as $usuario) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">person</span>
                        Usuario ID: <?php echo ($usuario->getId_empleado()); ?>
                    </h3>
                    <hr />
                    <p>
                        <strong><span class="material-icons">person_outline</span> Usuario:</strong> <?php echo ($usuario->getUser()); ?><br>
                        <strong><span class="material-icons">badge</span> Nombre:</strong> <?php echo ($usuario->getNombre()); ?> <?php echo ($usuario->getApellido()); ?><br>
                        <strong><span class="material-icons">security</span> Rol:</strong> <?php echo ($usuario->getRol()); ?><br>
                        <strong><span class="material-icons">check_circle</span> Estado:</strong> <?php echo ($usuario->getEstado()); ?><br>
                        <strong><span class="material-icons">email</span> Correo:</strong> <?php echo ($usuario->getEmail() == '' ? 'No hay data' : $usuario->getEmail()); ?>
                    </p>
                    <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($usuario->getId_empleado()); ?>">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($usuario->getId_empleado()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span> Agregar Usuario
        </button>
    </div>
    
    <script src="../public/js/usuarioView.js"></script>
</body>

</html>
