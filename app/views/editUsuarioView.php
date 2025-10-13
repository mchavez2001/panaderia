<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Editar Usuario</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Editar Usuario</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_usuario" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Usuario" value="<?php echo($usuario->getUser()); ?>" type="text" id="user" name="user" required>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Clave" type="password" id="clave" name="clave" required>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombres" value="<?php echo($usuario->getNombre()); ?>" type="text" id="nombres" name="nombres">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Apellidos" value="<?php echo($usuario->getApellido()); ?>" type="text" id="apellidos" name="apellidos">
                    </div>
                    <label for="rol">Rol</label>
                    <select class="select-field" name="rol" id="rol">
                        <option value="estandar" <?php echo $usuario->getRol() === 'estandar' ? 'selected' : ''; ?>>Usuario</option>
                        <option value="administrador" <?php echo $usuario->getRol() === 'administrador' ? 'selected' : ''; ?>>Administrador</option>
                    </select>
                    <label for="estado">Estado</label>
                    <select class="select-field" name="estado" id="estado">
                        <option value="activo" <?php echo $usuario->getEstado() === 'activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo $usuario->getEstado() === 'inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Correo" value="<?php echo($usuario->getEmail()); ?>" type="text" id="correo" name="correo">
                    </div>
                    <button class="create-button" type="submit" name="action" value="update">Actualizar</button>
<!--                     <button class="create-button" type="submit" name="action" value="cancel">Cancelar</button> -->
                    <input type="hidden" id="id" name="id" value="<?php echo($usuario->getId_empleado()); ?>" required>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
