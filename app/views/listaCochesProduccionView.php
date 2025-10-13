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
    <?php require_once 'nav.php'; ?>
    <a class="back" href="produccion">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista De Coches a Producir</h2>
        <p class="subtitulo-general">Registra las producciones que realizaras</p>
        <div class="table-container desktop-view">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTO</th>
                        <th>COCHES</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr class="elementos">
                            <td><?php echo ($producto->getCod_prod()) ?></td>
                            <td><?php echo ($producto->getNom_prod()) ?></td>
                            <td style="text-align: center;"><?php echo ($producto->getCant_prod()) ?></td>
                            <td>
                                <form action="/panaderia/public/productos_produccion" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($producto->getCod_prod()); ?>">
                                    <button type="submit" class="productos" value="editar">
                                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($producto->getCod_prod()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($productos as $producto) : ?>
                <div class="card">
                    <h3 class="card-title"><span class="material-icons" style="color: #0869fa;">tag</span>ID: <?php echo ($producto->getCod_prod()); ?>
                    </h3>
                    <hr />
                    <p>
                        <span class="material-icons" style="color: #0869fa;">production_quantity_limits</span>
                        Producto: <?php echo ($producto->getNom_prod()); ?>
                    </p>
                    <p>
                        <span class="material-icons" style="color: #0869fa;">format_list_numbered</span>
                        Cantidad: <?php echo ($producto->getCant_prod()); ?> coches
                    </p>
                    <div class="card-actions">
                        <form action="/panaderia/public/productos_produccion" method="get" style="display:inline;">
                             <input type="hidden" name="id" value="<?php echo ($producto->getCod_prod()); ?>">
                             <button type="submit" class="productos">
                                 <span class="material-icons" style="color: #0869fa;">inventory</span>
                             </button>
                         </form>
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($producto->getCod_prod()); ?>">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php echo ($producto->getCod_prod()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Agregar Coche
        </button>
    </div>

    <script src="../public/js/cocheView.js"></script>
</body>

</html>