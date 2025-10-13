<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Compras</title>
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

        .precio {
            width: 100%;
        }

        .precios {
            display: flex;
            flex-direction: column;
            height: 50px;
            width: 100px;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php require_once 'nav.php'; ?>
    <a class="back" href="seguimiento_cuentas">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general" style="font-size: 1.5rem;"><?php echo $cliente->getNom_cliente() . ' ' . $cliente->getApell_cliente() ?></h2>
        <!-- <p class="subtitulo-general">Verifica y da seguimiento a todas las compras realizadas por el cliente</p>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." aria-label="Buscar ventas" />
            <input type="date" id="searchDateInput" aria-label="Buscar por fecha" />
        </div> -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>PRODUCTOS</th>
                        <th>FECHA</th>
                        <th>METODO PAGO</th>
                        <th>IMPORTE</th>
                        <th></th>
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $venta) : ?>
                        <tr class="elementos">
                            <td><?php echo ($venta->getCod_venta()) ?></td>
                            <td>
                                <?php
                                $name = '';
                                for ($i = 0; $i < count($productos[$venta->getCod_venta()]); $i++) {
                                    if ($i == 0) {
                                        $name = $productos[$venta->getCod_venta()][$i]->getCant_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getNom_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getTam_prod();
                                    } else {
                                        $name = $name . ', ' . $productos[$venta->getCod_venta()][$i]->getCant_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getNom_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getTam_prod();
                                    }
                                }
                                echo $name;
                                ?>
                            </td>
                            <td><?php echo ($venta->getFecha()) ?></td>
                            <td><?php echo ($venta->getMet_pag()) ?></td>
                            <td><?php echo 'S/ ' . number_format($venta->getImporte(), 2); ?></td>
                            <td>
                                <form action="/panaderia/public/producto_venta_seguimiento" method="get">
                                    <input type="hidden" name="id" value="<?php echo ($venta->getCod_venta()); ?>">
                                    <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">inventory</span></button>
                                </form>
                            </td>
                            <!-- <td>
                                <form action="/panaderia/public/finalizar_venta" method="get">
                                    <input type="hidden" name="id" value="<?php #echo ($venta->getCod_venta()); 
                                                                            ?>">
                                    <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">check</span></button>
                                </form>
                            </td> -->
                            <!-- <td style="text-align: center;">
                                <button type="button" class="edit" data-id="<?php #echo ($venta->getCod_venta()); 
                                                                            ?>" data-bs-toggle="modal" data-bs-target="#confirmMsgModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: green;">check</span>
                                </button>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="concepto">
            <div class="box-concepto">
                <div class="box-content">
                    <span class="material-icons iconcepto" style="color: green; margin-right: 4px; font-size: 1rem;">money_bag</span>
                    <div class="saldo">Debe: <?php echo 'S/ ' . number_format($cuenta->getSaldo(), 2); ?></div>
                </div>
            </div>
            <div class="box-concepto">
                <div class="box-content">
                    <span class="material-icons iconcepto" style="color: green; margin-right: 4px; font-size: 1rem;">payments</span>
                    <div class="abono">Abono: <?php echo 'S/ ' . number_format($abono ?? 0, 2); ?></div>
                </div>
            </div>
        </div>
        <div class="mobile-cards" style="gap: 0;">
            <?php foreach ($ventas as $venta) : ?>
                <div class="card" style="display: flex; flex-direction: row; align-items: center; gap: 2px;">
                    <h3 class="card-title" style="font-size: .9rem; width: 100%;">
                        <span class="material-icons" style="color: #0869fa; margin-right: 4px; font-size: 1rem;">shopping_cart</span>
                        <?php
                        $name = '';
                        for ($i = 0; $i < count($productos[$venta->getCod_venta()]); $i++) {
                            if ($i == 0) {
                                $name = $productos[$venta->getCod_venta()][$i]->getCant_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getNom_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getTam_prod();
                            } else {
                                $name = $name . ', ' . $productos[$venta->getCod_venta()][$i]->getCant_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getNom_prod() . ' ' . $productos[$venta->getCod_venta()][$i]->getTam_prod();
                            }
                        }
                        echo $name;
                        ?>
                        <p class="card-date" style="padding-top: 5px; margin-bottom: 0;">
                            <!-- <span class="material-icons" style="color: #0869fa; margin-right: 4px;">calendar_today</span> -->
                            <?php
                            $fechaAct = new DateTime();
                            $fechaVenta = new DateTime($venta->getFecha());
                            $fechaDiff = $fechaAct->diff($fechaVenta);
                            if ($fechaDiff->days > 0 && $fechaDiff->days < 30) {
                                echo ('Hace ' . $fechaDiff->days . ' días');
                            } else if ($fechaDiff->days >= 30 && $fechaDiff->days < 60) {
                                echo ('Hace 1 mes');
                            } else if ($fechaDiff->days == 0) {
                                echo ('Hoy');
                            } else if ($fechaDiff->days >= 60) {
                                echo $venta->getFecha();
                            }
                            /* if ($fechaDiff->days > 0 && $fechaDiff->days < 30) {
                                echo ('Hace ' . $fechaDiff->days . ' días');
                            } else if ($fechaDiff->days >= 30 && $fechaDiff->days < 60) {
                                echo ('Hace 1 mes');
                            } else if ($fechaDiff->days >= 60 && $fechaDiff->days < 90) {
                                echo ('Hace 2 meses');
                            } else if ($fechaDiff->days == 0) {
                                echo ('Hoy');
                            } */
                            ?>
                        </p>
                    </h3>
                    <div class="precios">
                        <div class="precio" style="font-size: 0.9rem;">
                            <?php echo 'S/ ' . number_format($venta->getImporte() ?? 0, 2); ?>
                        </div>
                        <?php if ($importes_productos[$venta->getCod_venta()] != $venta->getImporte()) { ?>
                            <div class="precio" style="font-size: 0.9rem; text-decoration: line-through !important;">
                                <?php echo 'S/ ' . number_format($importes_productos[$venta->getCod_venta()] ?? 0, 2); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="detalle" style="width: 15%;">
                        <form action="/panaderia/public/producto_venta_seguimiento" method="get">
                            <input type="hidden" name="id" value="<?php #echo ($venta->getCod_venta()); 
                                                                    ?>">
                            <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa; font-size: 1rem;;">visibility</span></button>
                        </form>
                    </div>

                    <!-- <div class="card-details"> -->
                    <!-- <div class="card-detail">
                            <span class="material-icons">payment</span>
                            <p><?php #echo ($venta->getMet_pag()) 
                                ?></p>
                        </div> -->
                    <!-- <div class="card-detail">
                            <span class="material-icons">monetization_on</span>
                            <p><?php #echo 'S/ ' . number_format($venta->getImporte(), 2); 
                                ?></p>
                        </div> -->
                    <!-- <div class="card-detail">
                            <span class="material-icons">attach_money</span>
                            <p><?php #echo 'S/ ' . number_format($abonado[$venta->getCod_venta()], 2); 
                                ?></p>
                        </div>
                        <div class="card-detail">
                            <span class="material-icons">money_off</span>
                            <p><?php #echo 'S/ ' . number_format($venta->getMonto_tot() - $abonado[$venta->getCod_venta()], 2); 
                                ?></p>
                        </div> -->
                    <!-- </div>
 -->
                    <!-- <div class="card-actions"> -->
                    <!-- <button type="button" class="detail" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($venta->getCod_venta()); 
                                                                                                                            ?>">
                            <span class="material-icons" style="color: #0869fa;">visibility</span>
                        </button>
                        <form action="/panaderia/public/producto_venta_seguimiento" method="get">
                            <input type="hidden" name="id" value="<?php #echo ($venta->getCod_venta()); 
                                                                    ?>">
                            <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">inventory</span></button>
                        </form> -->
                    <!-- <form action="/panaderia/public/venta_abono" method="get">
                            <input type="hidden" name="id" value="<?php #echo ($venta->getCod_venta()); 
                                                                    ?>">
                            <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">payments</span></button>
                        </form>
                        <button type="button" class="edit" data-id="<?php #echo ($venta->getCod_venta()); 
                                                                    ?>" data-bs-toggle="modal" data-bs-target="#confirmMsgModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: green;">check</span>
                        </button> -->

                    <!-- </div> -->
                </div>
            <?php endforeach; ?>
        </div>
        <a class="create" href="">Descargar Reporte</a>
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
    <script src="../public/js/seguimientoView.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">