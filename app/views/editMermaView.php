<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css"> <!-- Cambia a tu hoja de estilos general -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Crear Producción</title>
</head>

<body class="bodyForm"> <!-- Aplicar la clase del cuerpo de la hoja de estilos -->
    <div class="modal-content"> <!-- Cambiar a la clase de contenedor principal -->
        <h2 class="form-title">EDITAR MERMA PARA PRODUCCIÓN</h2> <!-- Usar clase para el título -->
        <div class="form-separator"></div> <!-- Usar clase para la línea decorativa -->
        <div class="user-form"> <!-- Cambiar a la clase del formulario -->
            <form action="/panaderia/public/editar_merma" method="post">
                <div class="input-wrapper"> <!-- Contenedor para inputs -->
                    <label for="producto">Producto:</label>
                    <select name="producto" id="producto" class="select-field">
                        <option value="Pan" <?php echo $merma->getProducto() === 'Pan' ? 'selected' : ''; ?>>Pan</option>
                        <option value="Bizcocho" <?php echo $merma->getProducto() === 'Bizcocho' ? 'selected' : ''; ?>>Bizcocho</option>
                    </select>
                </div>
                <div class="input-wrapper"> <!-- Contenedor para inputs -->
                    <label for="tamaño">Producto:</label>
                    <select name="tamaño" id="producto" class="select-field">
                        <option value="Pequeño" <?php echo $merma->getTamaño() === 'Pequeño' ? 'selected' : ''; ?>>Pequeño</option>
                        <option value="Mediano" <?php echo $merma->getTamaño() === 'Mediano' ? 'selected' : ''; ?>>Mediano</option>
                        <option value="Grande" <?php echo $merma->getTamaño() === 'Grande' ? 'selected' : ''; ?>>Grande</option>
                    </select>
                </div>
                <div class="input-wrapper"> <!-- Contenedor para inputs -->
                    <label for="motivo">Motivo:</label>
                    <select name="motivo" id="motivo" class="select-field">
                        <option value="Merma" <?php echo $merma->getMotivo() === 'Merma ' ? 'selected' : ''; ?>>Merma</option>
                        <option value="Caducidad" <?php echo $merma->getMotivo() === 'Caducidad' ? 'selected' : ''; ?>>Caducidad</option>
                        <option value="Consumo Interno" <?php echo $merma->getMotivo() === 'Consumo Interno' ? 'selected' : ''; ?>>Consumo Interno</option>
                    </select>
                </div>
                <div class="input-wrapper">
                    <input placeholder="Cantidad de merma" type="number" step="any" id="cantidad" name="cantidad" min=0 class="input-field" value="<?php echo $merma->getCantidad(); ?>">
                </div>
                <div class="input-wrapper">
                    <input placeholder="Fecha de merma" type="date" id="fecha" name="fecha" class="input-field" value="<?php echo $merma->getFecha(); ?>">
                    <div class="input-wrapper">
                        <input type="hidden" name="cod_merma" value="<?php echo $merma->getCodMerma(); ?>"> <!-- Campo oculto para el ID de la merma -->
                    </div>
                    <button class="create-button" type="submit" name="action" value="update">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>