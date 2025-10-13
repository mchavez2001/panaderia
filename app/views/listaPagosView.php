<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Lista de Pagos</title>
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
    <a class="back" href="pagos">Volver</a>
    <div class="cuerpo">
        <h2 class="titulo-general">Lista de Pagos</h2>
        <p class="subtitulo-general">Administración de los pagos a realizar</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." aria-label="Buscar clientes" />
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Pago</th>
                        <th>Servicio</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Metodo Pago</th>
                        <th>Pago Unitario</th>
                        <th>Pago Total</th>
                        <th>Fecha Pago</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="clientesTableBody">
                    <?php foreach ($pagos as $pago) : ?>
                        <tr class="elementos">
                            <td><?php echo ($pago->getCod_pago()) ?></td>
                            <td><?php echo ($pago->getCod_servicio()) ?></td>
                            <td><?php echo ($pago->getDscr()) ?></td>
                            <td><?php echo ($pago->getCantidad()) ?></td>
                            <td><?php echo ($pago->getTip_unidad()) ?></td>
                            <td><?php echo ($pago->getMet_pag()) ?></td>
                            <td><?php echo ($pago->getPago_uni()) ?></td>
                            <td><?php echo ($pago->getPago_tot()) ?></td>
                            <td><?php echo ($pago->getFecha_pago()) ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($pago->getCod_pago()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($pago->getCod_pago()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($pagos as $pago) : ?>
                <div class="card" onclick="event.stopPropagation();">
                    <h3 class="card-title">
                        <span class="material-icons" style="vertical-align: middle; color: #0869fa; margin-right: 4px;">payments</span>
                        <?php echo ('ID '.$pago->getCod_pago().': '.$pago->getCod_servicio()) ?>
                    </h3>
                    <hr />
                    <div class="card-details">
                        <div class="card-detail">
                            <span class="material-icons">inventory_2</span>
                            <p><?php echo ($pago->getCantidad()) ?></p>
                        </div>
                        <!-- <div class="card-detail">
                            <span class="material-icons">straighten</span>
                            <p><?php #echo ($pago->getTip_unidad()) ?></p>
                        </div> -->
                        <div class="card-detail">
                            <span class="material-icons">credit_card</span>
                            <p><?php echo ($pago->getMet_pag()) ?></p>
                        </div>
                        <div class="card-detail">
                            <span class="material-icons">event</span>
                            <p><?php echo ($pago->getFecha_pago()) ?></p>
                        </div>
                    </div>

                    <div class="card-details">
                        <div class="card-detail">
                            <span class="material-icons">attach_money</span>
                            <p><?php echo ($pago->getPago_uni()) ?></p>
                        </div>
                        <div class="card-detail">
                            <span class="material-icons">calculate</span>
                            <p><?php echo ($pago->getPago_tot()) ?></p>
                        </div>
                    </div>

                    <div class="card-actions">
                        <button type="button" class="detail" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($pago->getCod_pago()); ?>">
                            <span class="material-icons" style="color: #0869fa;">visibility</span>
                        </button>
                        <!-- <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($pago->getCod_pago()); ?>" onclick="event.stopPropagation();">
                            <span class="material-icons">edit</span>
                        </button> -->
                        <button type="button" class="btn-delete" data-id="<?php echo ($pago->getCod_pago()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="event.stopPropagation();">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Pago
        </button>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            filterTableAndCards();
        });

        function filterTableAndCards() {
            var nameInput = document.getElementById("searchInput").value.toLowerCase();
            var rows = document.querySelectorAll("#clientesTableBody tr");
            var cards = document.querySelectorAll(".mobile-cards .card");

            rows.forEach(function(row) {
                var nameCell = row.children[2].textContent.toLowerCase();
                row.style.display = nameCell.includes(nameInput) ? "" : "none";
            });

            cards.forEach(function(card) {
                var cardName = card.querySelector(".card-title").textContent.toLowerCase();
                card.style.display = cardName.includes(nameInput) ? "block" : "none";
            });
        }
    </script>
    <script src="../public/js/pagoView.js"></script>
</body>

</html>