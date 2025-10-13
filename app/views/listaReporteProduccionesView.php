<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Lista De Productos a Producir</title>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <div class="cuerpo">
        <h2>Lista De Productos a Producir</h2>
        <table border="1" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PRODUCTO</th>
                    <th>DESCRIPCIÓN</th>
                    <th>TAMAÑO</th>
                    <th>CANTIDAD</th>
                    <th>UNIDAD</th>
                    <th>ADICIONAL</th>
                    <th>UNIDAD</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) : ?>
                    <tr class="elementos">
                        <td><?php echo ($producto->getCod_prod()) ?></td>
                        <td><?php echo ($producto->getNom_prod()) ?></td>
                        <td><?php echo ($producto->getDscr_prod()) ?></td>
                        <td style="text-align: center;"><?php echo ($producto->getTam_prod()) ?></td>
                        <td style="text-align: center;"><?php echo ($producto->getCant_prod()) ?></td>
                        <td style="text-align: center;">BOLSAS</td>
                        <td style="text-align: center;"><?php echo ($producto->getCant_extra()) ?></td>
                        <td style="text-align: center;">UNIDADES</td>
                        <td>
                            <form action="/panaderia/public/editar_producto_produccion" method="get">
                                <input type="hidden" name="id" value="<?php echo ($producto->getCod_prod()); ?>">
                                <button type="submit" value="editar">Editar</button>
                            </form>
                        </td>
                        <td>
                            <form action="/panaderia/public/eliminar_producto_produccion" method="post">
                                <input type="hidden" name="id" value="<?php echo ($producto->getCod_prod()); ?>">
                                <button type="submit" name="action" value="eliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="create" href="agregar_produccion">+ Añadir Produccion</a>
    </div>
</body>

</html>