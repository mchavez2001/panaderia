<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Lista de Pedidos</title>
    <style>
        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-container input {
            flex: 1;
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: rgba(255, 255, 255, 0.8);
            /* Fondo semitransparente para el input */
        }

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
            }

            .search-container input {
                margin-right: 0;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="ventas">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Pedidos</h2>
        <p class="subtitulo-general">Administración de las pedidos registrados</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." aria-label="Buscar ventas" />
            <input type="date" id="searchDateInput" aria-label="Buscar por fecha" />
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLIENTE</th>
                        <th>VENDEDOR</th>
                        <th>FECHA PEDIDO</th>
                        <th>METODO PAGO</th>
                        <th>IMPORTE</th>
                        <th>PASAJE</th>
                        <th>COMENTARIO</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="ventasTableBody">
                    <?php foreach ($ventas as $venta) : ?>
                        <?php #if($venta->getImporte()>0){ 
                        ?>
                        <tr class="elementos">
                            <td><?php
                                foreach ($pedidos as $pedido) {
                                    if ($pedido->getCod_venta() == $venta->getCod_venta()) {
                                        echo $pedido->getCod_pedido();
                                    }
                                }
                                ?></td>
                            <td><?php echo ($venta->getCod_cuenta()) ?></td>
                            <td><?php echo ($venta->getCod_empleado()) ?></td>
                            <td><?php echo ($venta->getFecha()) ?></td>
                            <td><?php echo ($venta->getMet_pag()) ?></td>
                            <td><?php echo 'S/ ' . number_format($venta->getImporte(), 2); ?></td>
                            <td><?php echo 'S/ ' . number_format($venta->getMont_pasaj(), 2); ?></td>
                            <td><?php
                                foreach ($pedidos as $pedido) {
                                    if ($pedido->getCod_venta() == $venta->getCod_venta()) {
                                        echo $pedido->getDscr();
                                    }
                                }
                                ?></td>
                            <td>
                                <form action="/panaderia/public/producto_pedido" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($venta->getCod_venta()); ?>">
                                    <button type="submit" class="productos" value="editar">
                                        <span class="material-icons" style="color: #0869fa;">inventory</span>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <?php foreach ($pedidos as $pedido) {
                                    if ($pedido->getCod_venta() == $venta->getCod_venta()) { ?>
                                        <form action="/panaderia/public/cuenta_abono_adelanto" method="get">
                                            <input type="hidden" name="id" value="<?php echo ($pedido->getCod_pedido()); ?>">
                                            <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">payments</span></button>
                                        </form>
                                <?php    }
                                } ?>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($venta->getCod_venta()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($venta->getCod_venta()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                        <?php #} 
                        ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($ventas as $venta) : ?>
                <div class="card" onclick="event.stopPropagation();">
                    <h3 class="card-title">
                        <span class="material-icons" style="vertical-align: middle; color: #0869fa; margin-right: 4px;">shopping_cart</span>
                        <?php echo ($venta->getCod_cuenta()) ?>
                    </h3>
                    <hr /> <!-- Separador agregado -->
                    <div class="card-id-date">
                        <p class="client-id">
                            <span class="material-icons" style="vertical-align: middle; color: #0869fa; margin-right: 4px;">badge</span>
                            <?php echo ($venta->getCod_venta()) ?>
                        </p>
                        <p class="card-date">
                            <span class="material-icons" style="vertical-align: middle; color: #0869fa; margin-right: 4px;">calendar_today</span>
                            <?php echo ($venta->getFecha()) ?>
                        </p>
                    </div>

                    <div class="card-details">
                        <div class="card-detail">
                            <span class="material-icons">payment</span>
                            <p><?php echo ($venta->getMet_pag()) ?></p>
                        </div>
                        <div class="card-detail">
                            <span class="material-icons">monetization_on</span>
                            <p><?php echo 'S/ ' . number_format($venta->getImporte(), 2); ?></p>
                        </div>
                    </div>
                    <div class="card-actions">
                        <!-- <button type="button" class="detail" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($venta->getCod_venta()); ?>">
                            <span class="material-icons" style="color: #0869fa;">visibility</span>
                        </button> -->
                        <?php foreach ($pedidos as $pedido) {
                            if ($pedido->getCod_venta() == $venta->getCod_venta()) { ?>
                                <form action="/panaderia/public/cuenta_abono_adelanto" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($pedido->getCod_pedido()); ?>">
                                    <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">payments</span></button>
                                </form>
                        <?php    }
                        } ?>
                        <form action="/panaderia/public/producto_pedido" method="get" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo ($venta->getCod_venta()); ?>">
                            <button type="submit" class="productos">
                                <span class="material-icons" style="color: #0869fa;">inventory</span>
                            </button>
                        </form>
                        <!-- <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($venta->getCod_venta()); 
                                                                                                                                ?>" onclick="event.stopPropagation();">
                            <span class="material-icons">edit</span>
                        </button> -->
                        <button type="button" class="btn-delete" data-id="<?php echo ($venta->getCod_venta()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="event.stopPropagation();">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Pedido
        </button>
    </div>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            filterTableAndCards();
        });

        document.getElementById("searchDateInput").addEventListener("change", function() {
            filterTableAndCards();
        });

        function filterTableAndCards() {
            var nameInput = document.getElementById("searchInput").value.toLowerCase();
            var dateInput = document.getElementById("searchDateInput").value.toLowerCase(); // Obtener la fecha
            var rows = document.querySelectorAll("#ventasTableBody tr"); // Filas de la tabla
            var cards = document.querySelectorAll(".mobile-cards .card"); // Tarjetas móviles

            // Filtrar tabla
            rows.forEach(function(row) {
                var nameCell = row.children[1].textContent.toLowerCase();
                var dateCell = row.children[3].textContent.toLowerCase(); // Celda de fecha
                var matchesName = nameCell.includes(nameInput);
                var matchesDate = dateCell.includes(dateInput); // Verificar coincidencia de fecha
                row.style.display = matchesName && (dateInput === '' || matchesDate) ? "" : "none"; // Filtrar por nombre y fecha
            });

            // Filtrar tarjetas
            cards.forEach(function(card) {
                var cardName = card.querySelector(".card-title").textContent.toLowerCase();
                var cardDate = card.querySelector(".card-date").textContent.toLowerCase(); // Fecha en la tarjeta
                var cardMatchesName = cardName.includes(nameInput);
                var cardMatchesDate = cardDate.includes(dateInput); // Verificar coincidencia de fecha
                card.style.display = cardMatchesName && (dateInput === '' || cardMatchesDate) ? "block" : "none"; // Filtrar por nombre y fecha
            });
        }
    </script>
    <script src="../public/js/pedidosView.js"></script>
</body>

</html>