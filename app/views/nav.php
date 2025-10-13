<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Incluir Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Script para cargar el formulario en el modal -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS (incluye Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- JavaScript de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/nav.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../public/img/favicon.ico" type="image/x-icon">
    <title>Navegación</title>

</head>

<body>
    <?php require_once('modalView.php') ?>
    <nav class="custom-nav"> <!-- Cambié la clase nav a custom-nav -->
        <div class="custom-nav-container"> <!-- Cambié nav-container a custom-nav-container -->
            <!-- <div class="custom-logo">INTRANET</div>  --><!-- Cambié logo a custom-logo -->
            <div class="custom-logo" style="width: 160px;"><img style="width: 100%;" src="../public/img/logo.png" alt=""></div> <!-- Cambié logo a custom-logo -->
            <div class="custom-menu-icon" onclick="toggleMenu()">&#9776;</div> <!-- Cambié menu-icon a custom-menu-icon -->
            <ul class="custom-list" id="menu"> <!-- Cambié lista a custom-list -->
                <?php if ($_SESSION['rol'] == 'administrador') { ?>
                    <li class="custom-item"><a class="custom-link" href="usuarios">Usuarios</a></li> <!-- Cambié items a custom-item y links a custom-link -->
                <?php } ?>
                <li class="custom-item"><a class="custom-link" href="dashboard">Dashboard</a></li>
                <li class="custom-item"><a class="custom-link" href="insumos">Inventario Insumos</a></li>
                <li class="custom-item"><a class="custom-link" href="produccion">Producción</a></li>
                <li class="custom-item"><a class="custom-link" href="productos">Inventario Productos</a></li>
                <li class="custom-item"><a class="custom-link" href="ventas">Ventas</a></li>
                <!-- <li class="custom-item"><a class="custom-link" href="control">Gastos y Costos</a></li> -->
                <li class="custom-item"><a class="custom-link" href="pagos">Pagos y Servicios</a></li>
                <li class="custom-item"><a class="custom-link user-link" href="#"><i class="fas fa-user"></i> <?php echo $_SESSION['nombre']; ?></a></li>
                <li class="custom-item"><a class="custom-link logout" href="/panaderia/public/logout"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
            </ul>
        </div>
    </nav>
    <script>
        $(".custom-menu-icon").click(function() {
            if ($("#menu").is(":visible")) {
                $("#menu").slideUp(300).fadeOut(300);
            } else {
                $("#menu").slideDown(300).fadeIn(300);
            }
        });
    </script>

</body>

</html>