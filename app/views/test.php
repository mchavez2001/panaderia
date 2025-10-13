<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Seguimiento de Ventas</title>
</head>

<body>
    <?php
    require_once 'nav.php';
    ?>
    <div class="cuerpo">
        <h2>Seguimiento de Ventas</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLIENTE</th>
                        <th>FECHA</th>
                        <th>METODO PAGO</th>
                        <th>IMPORTE</th>
                        <th>ABONADO</th>
                        <th>DEBE</th>
                        <th>ESTADO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr class="elementos">
                            <td><?php echo ($venta->getCod_venta()) ?></td>
                            <td><?php echo ($venta->getCod_cliente()) ?></td>
                            <td><?php echo ($venta->getFecha()) ?></td>
                            <td><?php echo ($venta->getMet_pag()) ?></td>
                            <td><?php echo ($venta->getMonto_tot()) ?></td>
                            <td><?php 
                            /* $pagado = 0;
                            foreach ($productos[$venta->getCod_venta()] as $producto) {
                                if($producto->getEst() == '1'){
                                    $pagado = $pagado + $producto->getPrecio_tot();
                                }
                            } */
                            echo($abonado[$venta->getCod_venta()]);
                            ?></td>
                            <td><?php 
                            /* $debe = 0;
                            foreach ($productos[$venta->getCod_venta()] as $producto) {
                                if($producto->getEst() == '0'){
                                    $debe = $debe + $producto->getPrecio_tot();
                                }
                            } */
                            echo($venta->getMonto_tot() - $abonado[$venta->getCod_venta()]);
                            ?></td>
                            <td style="text-align: center;"><?php 
                            if($venta->getEstado() == 0){
                            echo('En proceso');    
                            }else{
                                echo('Venta Completada');
                            }
                            ?></td>
                            <td>
                                <form action="/panaderia/public/producto_venta_seguimiento" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($venta->getCod_venta()); ?>">
                                    <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">inventory</span></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a class="create" href="finalizar_ventas">Finalizar Ventas</a>
    </div>
</body>

</html>