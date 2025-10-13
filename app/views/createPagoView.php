<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Pago</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Añadir Pago</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/agregar_pago" method="post">
                    <div class="input-wrapper">
                        <label for="servicio">Servicio:</label>
                        <select class="select-field" name="servicio" id="servicio" style="width: 100%;">
                            <option value=""></option>
                            <?php foreach ($servicios as $servicio) { ?>
                                <option value="<?php echo $servicio->getCod_servicio(); ?>"><?php echo $servicio->getNom_servicio(); ?></option>
                            <?php } ?>
                        </select><br>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Descripcion" type="text" id="dscr" name="dscr">
                    </div>
                    <div class="input-wrapper">
                        <label for="cant">Cantidad: </label>
                        <input type="number" min="1" step="any" id="cantidad" name="cantidad" class="input-field">
                    </div>
                    <div class="input-wrapper">
                        <label for="categoria">Tipo Unidad:</label>
                        <select class="select-field" name="unidad" id="unidad" style="width: 100%;">
                            <option value="UNIDAD">UNIDAD</option>
                            <option value="GALONES">GALONES</option>
                            <option value="PAQUETES">PAQUETES</option>
                        </select><br>
                    </div>
                    <div class="input-wrapper">
                        <label for="categoria">Metodo de Pago:</label>
                        <select class="select-field" name="met_pago" id="met_pago" style="width: 100%;">
                            <option value="EFECTIVO">EFECTIVO</option>
                            <option value="YAPE">YAPE</option>
                            <option value="PLIN">PLIN</option>
                            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                        </select><br>
                    </div>
                    <div class="input-wrapper">
                        <label for="precio">Pago Unitario:</label>
                        <input type="number" step="any" id="pago" name="pago" class="input-field">
                    </div>
                    <div class="input-wrapper">
                        <label for="precio">Fecha de Pago:</label>
                        <input type="date" id="fecha" name="fecha" class="input-field">
                    </div>
                    <button class="create-button" type="submit" name="action" value="guardar">Añadir Pago</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#servicio').select2({
                placeholder: "Busca una opción",
                allowClear: true,
                tags: true,
                dropdownParent: $('#formContent').parent()
            });
        });
    </script>
</body>

</html>