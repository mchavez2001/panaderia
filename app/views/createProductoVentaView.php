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

        <!-- Tabla para mostrar los productos disponibles -->
        <table class="product-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Tamaño</th>
                    <th>Stock</th>
                    <th>Bolsas Disponibles</th>
                    <th>Unidades Sobrantes</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td><?php echo $producto->getNom_prod(); ?></td>
                        <td><?php echo $producto->getTam_prod(); ?></td>
                        <td><?php echo $producto->getCant_prod() . ' Unidades'; ?></td>
                        <td><?php
                            switch ($producto->getTam_prod()) {
                                case 'Pequeño':
                                    echo intval($producto->getCant_prod() / 42);
                                    break;
                                case 'Mediano':
                                    echo intval($producto->getCant_prod() / 21);
                                    break;
                                case 'Grande':
                                    echo intval($producto->getCant_prod() / 18);
                                    break;
                            }
                            ?></td>
                        <td><?php
                            switch ($producto->getTam_prod()) {
                                case 'Pequeño':
                                    $bolsas = intval($producto->getCant_prod() / 42);
                                    echo $producto->getCant_prod() - $bolsas * 42;
                                    break;
                                case 'Mediano':
                                    $bolsas = intval($producto->getCant_prod() / 21);
                                    echo $producto->getCant_prod() - $bolsas * 21;
                                    break;
                                case 'Grande':
                                    $bolsas = intval($producto->getCant_prod() / 18);
                                    echo $producto->getCant_prod() - $bolsas * 18;
                                    break;
                            }
                            ?></td>
                        <td>S/<?php echo $producto->getPrecio(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
        <!-- Formulario para añadir producto -->
        <div class="user-form">
            <form action="/panaderia/public/agregar_producto_venta" method="post">
                <div class="input-wrapper">
                    <label for="nombre">Nombre del Producto:</label>
                    <!-- <select name="nombre" id="nombre" class="select-field" onchange="actualizarTamanosYMaxBolsas()"> -->
                    <select name="nombre" id="nombre" class="select-field">
                        <option value="">Selecciona un producto...</option>
                        <option value="Pan">Pan</option>
                        <option value="Bizcocho">Bizcocho</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <input placeholder="Descripcion" type="text" id="desc" name="desc" class="input-field">
                </div>

                <div class="input-wrapper">
                    <label for="tamano">Tamaño:</label>
                    <!-- <select name="tamano" id="tamano" class="select-field" onchange="actualizarMaxBolsas()"> -->
                    <select name="tamano" id="tamano" class="select-field">
                        <option value="Pequeño">Pequeño</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="cant">Bolsas a vender:</label>
                    <input type="number" min="0" id="cant" name="cant" class="input-field">
                    <!-- <input type="number" min="0" id="cant" name="cant" class="input-field" max="
                    <?php
                    /* switch ($producto->getTam_prod()) {
                        case 'Pequeño':
                            echo intval($producto->getCant_prod() / 42);
                            break;
                        case 'Mediano':
                            echo intval($producto->getCant_prod() / 21);
                            break;
                        case 'Grande':
                            echo intval($producto->getCant_prod() / 18);
                            break;
                    } */
                    ?>"> -->
                </div>

                <div class="input-wrapper">
                    <label for="uni_med">Medida:</label>
                    <select name="uni_med" id="uni_med" class="select-field">
                        <option value="bolsas">bolsas</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="uni_med">Precio:</label>
                    <input type="text" id="precio" name="precio" class="input-field">
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