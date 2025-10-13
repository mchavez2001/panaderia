<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Usuario</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Crear Usuario</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/crear_usuario" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Usuario" type="text" id="user" name="user" required>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Clave" type="password" id="clave" name="clave" required>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombres" type="text" id="nombres" name="nombres">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Apellidos" type="text" id="apellidos" name="apellidos">
                    </div>
                    <label for="rol">Rol</label>
                    <select class="select-field" name="rol" id="rol">
                        <option value="estandar">Usuario</option>
                        <option value="administrador">Administrador</option>
                    </select>
                    <label for="estado">Estado</label>
                    <select class="select-field" name="estado" id="estado">
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Correo" type="text" id="correo" name="correo">
                    </div>
                    <button class="create-button" type="submit" name="action" value="crear">Crear</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
