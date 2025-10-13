<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Venta</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Añadir Pedido</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/agregar_pedido" method="post">
                    <label for="cliente">Cliente:</label>
                    <select class="select-field" name="cod_cuenta" id="cod_cuenta" style="width: 100%;">
                        <option value=""></option>
                        <?php foreach ($clientes as $cliente) { ?>
                            <option value="<?php echo $cliente->getId_cliente(); ?>"><?php echo $cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente(); ?></option>
                        <?php } ?>
                    </select><br><br>
                    <label for="fech_ped">Desea añadir algun comentario al pedido?</label>
                    <div class="input-wrapper">
                        <input placeholder="Ingrese el comentario" type="text" id="dscr" name="dscr" class="input-field">
                    </div>
                    <label for="fech_ped">Para que fecha sera el pedido?</label>
                    <div class="input-wrapper">
                        <input type="date" id="fech_ped" name="fech_ped" class="input-field">
                    </div>
                    <label for="met_pag">Método de Pago:</label>
                    <select class="select-field" name="met_pag" id="met_pag">
                        <option value="YAPE">YAPE</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Transferencia">Transferencia</option>
                    </select><br><br>
                    <div class="input-wrapper">
                        <label for="pasajeExist">Tendrá Pasaje?
                            <input class="check" type="checkbox" name="pasajeExist" id="pasajeExist">
                        </label>
                    </div>
                    <div class="input-wrapper">
                        <input placeholder="Ingrese el pasaje" type="text" id="pasaje" name="pasaje" class="input-field">
                    </div>
                    <label for="vendedor">¿Quien sera el vendedor a cargo de este pedido?:</label>
                    <select class="select-field" name="cod_empleado" id="cod_empleado">
                        <?php foreach ($vendedores as $vendedor) { ?>
                            <option value="<?php echo ($vendedor->getId_empleado()) ?>"><?php echo ($vendedor->getNombre()) ?></option>
                        <?php } ?>
                    </select><br><br>
                    <button class="create-button" type="submit" name="action" value="guardar">Añadir</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#cod_cuenta').select2({
                placeholder: "Busca una opción",
                allowClear: true,
                tags: true,
                dropdownParent: $('#formContent').parent()
            });
        });
    </script>
</body>

</html>