<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Crear Servicio</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">Añadir Servicio</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/agregar_servicio" method="post">
                    <div class="input-wrapper">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria" id="categoria" class="select-field">
                            <?php foreach ($categorias as $categoria) { ?>
                                <option value="<?php echo $categoria->getCod_categoria() ?>"><?php echo $categoria->getNom_categoria() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-wrapper">
                        <label for="subcategoria">Sub Categoria:</label>
                        <select name="subcategoria" id="subcategoria" class="select-field">
                            <?php foreach ($subcategorias as $subcategoria) { ?>
                                <option value="<?php echo $subcategoria->getCod_subcategoria() ?>"><?php echo $subcategoria->getNom_subcategoria() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Nombre Servicio" type="text" id="nombre" name="nombre">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Descripcion" type="text" id="dscr" name="dscr">
                    </div>
                    <div class="input-wrapper">
                        <label for="tipo_gasto">Tipo de Gasto:</label>
                        <select name="tipo_gasto" id="tipo_gasto" class="select-field">
                            <?php foreach ($categorias_det as $categoria_det) { ?>
                                <option value="<?php echo $categoria_det->getCod_categoria_det() ?>"><?php echo $categoria_det->getNom_categoria_det() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Proveedor" type="text" id="proveedor" name="proveedor">
                    </div>
                    <button class="create-button" type="submit" name="action" value="guardar">Añadir Servicio</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>