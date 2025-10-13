<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Seguimiento de Cuentas</title>
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
        <h2 class="titulo-general">Seguimiento de Cuentas</h2>
        <p class="subtitulo-general">Verifica y realiza abonos a las cuentas pendientes de los clientes</p>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." aria-label="Buscar ventas" />
            <!-- <input type="date" id="searchDateInput" aria-label="Buscar por fecha" /> -->
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLIENTE</th>
                        <th>SALDO</th>
                        <th>ABONADO</th>
                        <th>ESTADO</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cuentas as $cuenta) : ?>
                        <?php if ($cuenta->getSaldo() > 0) { ?>
                            <tr class="elementos">
                                <td><?php echo ($cuenta->getCod_cuenta()) ?></td>
                                <td><?php echo ($cuenta->getCod_cliente()) ?></td>
                                <td><?php echo 'S/ ' . number_format($cuenta->getSaldo() ?? 0, 2); ?></td>
                                <td><?php echo 'S/ ' . number_format($abonado[$cuenta->getCod_cuenta()] ?? 0, 2); ?></td>
                                <td><?php echo ($cuenta->getEstado() == 0 ? 'Sin deuda' : 'Pendiente'); ?></td>
                                <td>
                                    <form action="/panaderia/public/seguimiento_ventas" method="get">
                                        <input type="hidden" name="id" value="<?php echo ($cuenta->getCod_cuenta()); ?>">
                                        <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">shopping_cart</span></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="/panaderia/public/cuenta_abono" method="get">
                                        <input type="hidden" name="id" value="<?php echo ($cuenta->getCod_cuenta()); ?>">
                                        <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">payments</span></button>
                                    </form>
                                </td>
                                <!-- <td>
                                <form action="/panaderia/public/finalizar_venta" method="get">
                                    <input type="hidden" name="id" value="<?php #echo ($venta->getCod_venta()); 
                                                                            ?>">
                                    <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">check</span></button>
                                </form>
                            </td> -->
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($cuentas as $cuenta) : ?>
                <?php if ($cuenta->getSaldo() > 0) { ?>
                    <div class="card">
                        <h3 class="card-title">
                            <span class="material-icons" style="color: #0869fa; margin-right: 4px;">person</span>
                            <?php echo ($cuenta->getCod_cliente()) ?>
                        </h3>
                        <hr />
                        <!-- <div class="card-id-date">
                        <p class="client-id">
                            <span class="material-icons" style="color: #0869fa; margin-right: 4px;">tag</span>
                            <?php #echo ($cuenta->getCod_cuenta()) 
                            ?>
                        </p>
                    </div> -->

                        <div class="card-details">
                            <div class="card-detail">
                                <span class="material-icons">monetization_on</span>
                                <p><?php echo 'Saldo: S/ ' . number_format($cuenta->getSaldo(), 2); ?></p>
                            </div>
                            <div class="card-detail">
                                <span class="material-icons">attach_money</span>
                                <p><?php
                                    if ($abonado[$cuenta->getCod_cuenta()] > 0) {
                                        $din_abonado = $abonado[$cuenta->getCod_cuenta()];
                                    } else {
                                        $din_abonado = 0;
                                    }
                                    echo 'Abonado: S/ ' . number_format($din_abonado, 2);
                                    ?></p>
                            </div>
                            <?php if ($cuenta->getEstado() == 1) { ?>
                                <div class="card-detail">
                                    <span class="material-icons">verified</span>
                                    <p><?php echo ($cuenta->getEstado() == 0 ? 'Sin deuda' : 'Pendiente'); ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="card-detail">
                                    <span class="material-icons">error</span>
                                    <p><?php echo ($cuenta->getEstado() == 0 ? 'Sin deuda' : 'Pendiente'); ?></p>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="card-actions">
                            <button type="button" class="detail" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($cuenta->getCod_cuenta()); ?>">
                                <span class="material-icons" style="color: #0869fa;">visibility</span>
                            </button>
                            <form action="/panaderia/public/seguimiento_ventas" method="get">
                                <input type="hidden" name="id" value="<?php echo ($cuenta->getCod_cuenta()); ?>">
                                <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">shopping_cart</span></button>
                            </form>
                            <form action="/panaderia/public/cuenta_abono" method="get">
                                <input type="hidden" name="id" value="<?php echo ($cuenta->getCod_cuenta()); ?>">
                                <button type="submit" class="productos" value="editar"><span class="material-icons" style="color: #0869fa;">payments</span></button>
                            </form>
                            <!-- <button type="button" class="edit" data-id="<?php #echo ($venta->getCod_venta()); 
                                                                                ?>" data-bs-toggle="modal" data-bs-target="#confirmMsgModal" style="background: none; border: none; cursor: pointer;">
                            <span class="material-icons" style="color: green;">check</span>
                        </button> -->

                        </div>
                    </div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
        <!-- <a class="create" href="finalizar_ventas">Finalizar Ventas</a> -->
    </div>
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            filterTableAndCards();
        });

        function filterTableAndCards() {
            var nameInput = document.getElementById("searchInput").value.toLowerCase();
            var rows = document.querySelectorAll(".table-container tbody tr");
            var cards = document.querySelectorAll(".mobile-cards .card");

            rows.forEach(function(row) {
                var nameCell = row.children[1].textContent.toLowerCase();
                row.style.display = nameCell.includes(nameInput) ? "" : "none";
            });

            cards.forEach(function(card) {
                var cardName = card.querySelector(".card-title").textContent.toLowerCase();
                card.style.display = cardName.includes(nameInput) ? "block" : "none";
            });
        }
    </script>
    <script src="../public/js/seguimientoView.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">