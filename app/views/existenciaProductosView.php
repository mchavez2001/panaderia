<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Lista de Productos Disponibles Estimados</title>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="productos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Productos Disponibles Estimados</h2>
        <p class="subtitulo-general">Visualiza y gestiona los productos disponibles</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th>DESCRIPCIÓN</th>
                        <th>TAMAÑO</th>
                        <th>BOLSAS</th>
                        <th>UNIDADES</th>
                        <th>STOCK</th>
                        <th>MEDIDA</th>
                        <th>PRECIO UNITARIO</th>
                        <th>PRECIO TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="elementos">
                            <td style="text-align: center;"><?php echo($producto->getCod_prod()) ?></td>
                            <td><?php echo($producto->getNom_prod()) ?></td>
                            <td><?php echo($producto->getDscr_prod()) ?></td>
                            <td><?php echo($producto->getTam_prod()) ?></td>
                            <td style="text-align: center;"><?php 
                            switch ($producto->getTam_prod()) {
                                case 'Pequeño':
                                    echo(intval($producto->getCant_prod()/42));
                                    break;
                                case 'Mediano':
                                    echo(intval($producto->getCant_prod()/21));
                                    break;
                                case 'Grande':
                                    echo(intval($producto->getCant_prod()/18));
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center;"><?php 
                            switch ($producto->getTam_prod()) {
                                case 'Pequeño':
                                    $bolsas = intval($producto->getCant_prod()/42);
                                    $rest = $producto->getCant_prod() - $bolsas * 42;
                                    echo($rest);
                                    break;
                                case 'Mediano':
                                    $bolsas = intval($producto->getCant_prod()/21);
                                    $rest = $producto->getCant_prod() - $bolsas * 21;
                                    echo($rest);
                                    break;
                                case 'Grande':
                                    $bolsas = intval($producto->getCant_prod()/18);
                                    $rest = $producto->getCant_prod() - $bolsas * 18;
                                    echo($rest);
                                    break;
                            }
                            ?></td>
                            <td style="text-align: center;"><?php echo($producto->getCant_prod()) ?></td>
                            <td style="text-align: center;"><?php echo('UNIDADES') ?></td>
                            <td><?php echo('S/'.$producto->getPrecio()) ?></td>
                            <td><?php
                            $bolsas = intval($producto->getCant_prod()/42);
                            $rest = $producto->getCant_prod() - $bolsas * 42;
                            $preciox7 = 1;
                            $preciox3 = 0.5;
                            $bloque7 = intval($rest/7);
                            $restBloque7 = $rest - $bloque7 * 7;
                            $bloque3 = intval($rest/3);
                            $precioRest = ($bloque7 * $preciox7) + ($bloque3 * $preciox3);
                            echo('S/'.$producto->getPrecio()*$bolsas + $precioRest);
                            ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($productos as $producto) : ?>
                <div class="card">
                    <h3 class="card-title">
                        <span class="material-icons" style="color: #0869fa;">shopping_cart</span>
                        Producto ID: <?php echo($producto->getCod_prod()) ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">description</span>
                        <?php echo($producto->getNom_prod()) ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">info</span>
                        Descripción: <?php echo($producto->getDscr_prod()) ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">scale</span>
                        Tamaño: <?php echo($producto->getTam_prod()) ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">layers</span>
                        Unidades: <?php echo($producto->getCant_prod()) ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">attach_money</span>
                        Precio Total: <?php
                            $bolsas = intval($producto->getCant_prod()/42);
                            $rest = $producto->getCant_prod() - $bolsas * 42;
                            $preciox7 = 1;
                            $preciox3 = 0.5;
                            $bloque7 = intval($rest/7);
                            $restBloque7 = $rest - $bloque7 * 7;
                            $bloque3 = intval($rest/3);
                            $precioRest = ($bloque7 * $preciox7) + ($bloque3 * $preciox3);
                            echo('S/'.$producto->getPrecio()*$bolsas + $precioRest);
                        ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <a class="create" href="catalogar_productos">Siguiente</a>
    </div>
</body>

</html>
