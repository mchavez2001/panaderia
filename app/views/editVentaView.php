<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Editar Venta</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Editar Venta</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_venta" method="post">
                    <label for="cliente">Cliente:</label>
                    <select class="select-field" name="cod_cliente" id="cod_cliente">
                        <?php foreach ($clientes as $cliente) { ?>
                            <option value="<?php echo $cliente->getId_cliente(); ?>" <?php echo $cuenta->getCod_cliente() === $cliente->getId_cliente() ? 'selected' : ''; ?>><?php echo $cliente->getNom_cliente().' '.$cliente->getApell_cliente(); ?></option>
                        <?php } ?>
                    </select><br><br>
                    
                    <label for="met_pag">Método de Pago:</label>
                    <select class="select-field" name="met_pag" id="met_pag">
                        <option value="YAPE" <?php echo $venta->getMet_pag() === 'YAPE' ? 'selected' : ''; ?>>YAPE</option>
                        <option value="Efectivo" <?php echo $venta->getMet_pag() === 'Efectivo' ? 'selected' : ''; ?>>Efectivo</option>
                        <option value="Transferencia" <?php echo $venta->getMet_pag() === 'Transferencia' ? 'selected' : ''; ?>>Transferencia</option>
                    </select><br><br>

                    <div class="input-wrapper">
                        <label for="pasajeExist">¿Tiene Pasaje?
                            <input class="check" type="checkbox" name="pasajeExist" id="pasajeExist" <?php echo $venta->getMont_pasaj() > 0 ? 'checked' : ''; ?>>
                        </label>
                    </div>
                    <div class="input-wrapper">
                        <input placeholder="Ingrese el pasaje" type="text" id="pasaje" name="pasaje" class="input-field" value="<?php echo $venta->getMont_pasaj(); ?>">
                    </div>

                    <label for="vendedor">Vendedor:</label>
                    <select class="select-field" name="cod_empleado" id="cod_empleado">
                        <?php foreach ($vendedores as $vendedor) { ?>
                            <option value="<?php echo $vendedor->getId_empleado(); ?>" <?php echo $vendedor->getId_empleado() == $venta->getCod_empleado() ? 'selected' : ''; ?>>
                                <?php echo $vendedor->getNombre(); ?>
                            </option>
                        <?php } ?>
                    </select><br><br>
                    <input type="hidden" id="old_importe" name="old_importe" value="<?php echo $old_importe; ?>">
                    <input type="hidden" id="old_pasaje" name="old_pasaje" value="<?php echo $old_pasaje; ?>">
                    <input type="hidden" id="cod_venta" name="cod_venta" value="<?php echo $venta->getCod_venta(); ?>">
                    <button class="create-button" type="submit" name="action" value="update">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        $('#cod_cliente').select2({
            placeholder: "Busca una opción",
            allowClear: true,
            tags: true,
            dropdownParent: $('#formContent').parent()
        });
    });
    </script>
</body>

</html>
