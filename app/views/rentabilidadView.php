<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/usuariosView.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Analisis Rentabilidad</title>
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
        <h2 class="titulo-general">Analisis Rentabilidad</h2>
        <p class="subtitulo-general">Realiza seguimiento a los pagos de servicios realizados</p>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Buscar por nombre..." aria-label="Buscar clientes" />
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID Categoria</th>
                        <th>Nombre Categoria</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="clientesTableBody">
                    <?php foreach ($categorias as $categoria) : ?>
                        <tr class="elementos">
                            <td><?php echo ($categoria->getCod_categoria()) ?></td>
                            <td><?php echo ($categoria->getNom_categoria()) ?></td>
                            <td><?php echo ($categoria->getDscr()) ?></td>
                            <td style="text-align: center;">
                                <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php echo ($categoria->getCod_categoria()); ?>">
                                    <span class="material-icons" style="color: #0869fa;">edit</span>
                                </button>
                            </td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-delete" data-id="<?php echo ($categoria->getCod_categoria()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" style="background: none; border: none; cursor: pointer;">
                                    <span class="material-icons" style="color: red;">delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="mobile-cards">
            <?php foreach ($categorias as $categoria) : ?>
                <div class="card" onclick="event.stopPropagation();">
                    <h3 class="card-title">
                        <span class="material-icons" style="vertical-align: middle; color: #0869fa; margin-right: 4px;">category</span>
                        <?php echo ($categoria->getNom_categoria()) ?>
                    </h3>
                    <hr />

                    <div class="card-details">
                        <?php foreach ($categorias_det_1 as $categoria_det_1) {
                            if ($categoria->getCod_categoria() == $categoria_det_1->getCod_categoria()) {
                        ?>
                                <div class="card-detail">
                                    <span class="material-icons">attach_money</span>
                                    <p><?php echo ($categoria_det_1->getNom_categoria_det() . ': S/.' . $categoria_det_1->getTotal())
                                        ?></p>
                                </div>
                        <?php
                            }
                        } ?>

                        <?php 
                        foreach ($categorias_det_2 as $categoria_det_2) {
                            $suma = 0;
                            foreach ($categorias_det_1 as $categoria_det_1) {
                                if($categoria_det_2->getCod_categoria() == $categoria_det_1->getCod_categoria()){
                                    $suma = $suma + $categoria_det_1->getTotal();
                                }
                            }
                            if ($categoria->getCod_categoria() == $categoria_det_2->getCod_categoria()) {
                        ?>
                                <div class="card-detail">
                                    <span class="material-icons">attach_money</span>
                                    <p><?php echo ($categoria_det_2->getNom_categoria_det() . ': S/.' . $suma)
                                        ?></p>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                    <hr />

                    <div class="card-details">
                        <?php foreach ($categorias_det_1 as $categoria_det_1) {
                            if ($categoria->getCod_categoria() == $categoria_det_1->getCod_categoria()) {
                        ?>
                                <div class="card-detail">
                                    <span class="material-icons">attach_money</span>
                                    <p><?php echo ($categoria_det_1->getNom_categoria_det() . ': S/.' . $categoria_det_1->getTotal())
                                        ?></p>
                                </div>
                        <?php
                            }
                        } ?>

                        <?php 
                        foreach ($categorias_det_2 as $categoria_det_2) {
                            $suma = 0;
                            foreach ($categorias_det_1 as $categoria_det_1) {
                                if($categoria_det_2->getCod_categoria() == $categoria_det_1->getCod_categoria()){
                                    $suma = $suma + $categoria_det_1->getTotal();
                                }
                            }
                            if ($categoria->getCod_categoria() == $categoria_det_2->getCod_categoria()) {
                        ?>
                                <div class="card-detail">
                                    <span class="material-icons">attach_money</span>
                                    <p><?php echo ($categoria_det_2->getNom_categoria_det() . ': S/.' . $suma)
                                        ?></p>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>


<!--                     <div class="card-actions">
                        <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#crearModal" data-id="<?php #echo ($categoria->getCod_categoria()); ?>" onclick="event.stopPropagation();">
                            <span class="material-icons">edit</span>
                        </button>
                        <button type="button" class="btn-delete" data-id="<?php #echo ($categoria->getCod_categoria()); ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="event.stopPropagation();">
                            <span class="material-icons" style="color: red;">delete</span>
                        </button>
                    </div> -->
                </div>
            <?php endforeach; ?>
        </div>
        <!-- <button type="button" class="create" data-bs-toggle="modal" data-bs-target="#crearModal" id="openModal">
            <span class="material-icons" style="color: white;">add</span>Añadir Categoria
        </button> -->
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
    <script src="../public/js/categoriaView.js"></script>
</body>

</html>