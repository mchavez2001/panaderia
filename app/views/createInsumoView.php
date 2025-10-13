<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Crear Insumo</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <h2 class="form-title">AÑADIR INSUMO</h2>
        <div class="form-separator"></div>
        <div class="user-form">
            <form action="/panaderia/public/agregar_insumo" method="post">
                <div class="input-wrapper">
                    <label for="nombre">Insumo:</label>
                    <select name="nombre" id="nombre" class="input-field">
                        <option value="Harina">Harina</option>
                        <option value="Azucar">Azucar</option>
                        <option value="Manteca">Manteca</option>
                        <option value="Levadura">Levadura</option>
                        <option value="Mejorador">Mejorador</option>
                        <option value="Sal">Sal</option>
                        <option value="Aceite">Aceite</option>
                        <option value="Leche">Leche</option>
                        <option value="Esencia de Bizcocho">Esencia de Bizcocho</option>
                        <option value="Anis">Anis</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <input placeholder="Descripción" type="text" id="desc" name="desc" class="input-field">
                </div>

                <div class="input-wrapper">
                    <input placeholder="Cantidad (sacos, cajas, etc)" type="text" id="bloque" name="bloque" class="input-field">
                </div>

                <div class="input-wrapper">
                    <select name="uni_bloque" id="uni_bloque" class="input-field">
                        <option value="sacos">sacos</option>
                        <option value="paquetes">paquetes</option>
                        <option value="cajas">cajas</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <label for="packExist">¿Contiene Unidades?</label>
                    <input class="check" type="checkbox" name="packExist" id="packExist">
                </div>

                <div class="input-wrapper">
                    <input placeholder="Cantidad de unidades" type="text" id="pack" name="pack" class="input-field">
                </div>

                <div class="input-wrapper">
                    <select name="uni_pack" id="uni_pack" class="input-field">
                        <option value="unid">unid</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <input placeholder="Peso individual" type="text" id="peso_ind" name="peso_ind" class="input-field">
                </div>

                <div class="input-wrapper">
                    <label for="uni_med">Medida</label>
                    <select name="uni_med" id="uni_med" class="input-field">
                        <option value="kg">kg</option>
                        <option value="lt">lt</option>
                        <option value="unid">unid</option>
                    </select>
                </div>

                <div class="input-wrapper">
                    <button class="create-button" type="submit" name="action" value="guardar">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
