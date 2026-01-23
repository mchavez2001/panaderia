<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Añadir Producto</title>
</head>

<body class="bodyForm">
    <?php
    $productosJS = [];
    foreach ($productos as $producto) {
        $productosJS[] = [
            'nom_prod' => $producto->getNom_prod(),
            'tam_prod' => $producto->getTam_prod(),
            'cant_prod' => $producto->getCant_prod(),
            'precio' => $producto->getPrecio()
        ];
    }
    ?>
    <div class="modal-content">
        <h2 class="form-title">AÑADIR PRODUCTO PARA VENTA <?php echo ($cod_venta); ?></h2>
        <div class="form-separator"></div>
        <br>
        <!-- Formulario para añadir producto -->
        <div class="user-form">
            <form action="/panaderia/public/agregar_producto_venta_abarrote" method="post">
                <div class="input-wrapper">
                    <label for="nombre">Nombre del Abarrote:</label>
                    <!-- <select name="nombre" id="nombre" class="select-field" onchange="actualizarTamanosYMaxBolsas()"> -->
                    <select name="nombre" id="nombre" class="select-field">
                        <option value="">Selecciona un abarrote...</option>
                        <?php foreach ($abarrotes as $abarrote): ?>
                            <option value="<?php echo $abarrote->getNom_prod(); ?>"><?php echo $abarrote->getNom_prod(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-wrapper">
                    <input placeholder="Descripcion" type="text" id="desc" name="desc" class="input-field">
                </div>

                <div class="input-wrapper">
                    <label for="cant">Cantidad a vender:</label>
                    <input type="number" step="0.01" min="0" value="0" id="cant" name="cant" class="input-field">
                </div>

                <div class="input-wrapper">
                    <label for="uni_med">Medida:</label>
                    <select name="uni_med" id="uni_med" class="select-field">
                        <option value="KG">KG</option>
                        <option value="UND">UND</option>
                        <option value="UND x6">UND x6</option>
                        <option value="DOC">DOC</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="uni_med">Precio:</label>
                    <input type="number" step="0.01" min="0" value="0" id="precio" name="precio" class="input-field">
                </div>

                <input type="hidden" id="cod" name="cod" value="<?php echo ($cod_venta); ?>">

                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="guardar">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const productos = <?php echo json_encode($productosJS); ?>;
    </script>
    <!-- <script src="../public/js/createVentasView.js"></script> -->
</body>

</html>