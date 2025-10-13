<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../public/css/createUsuario.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Edita Insumo del Dia</title>
</head>

<body class="bodyForm">
    <div class="modal-content">
        <div class="form-container">
            <h2 class="form-title">EDITAR INSUMO DEL DIA</h2>
            <div class="form-separator"></div>
            <div class="user-form">
                <form action="/panaderia/public/editar_insumo" method="post">
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Insumo" value="<?php echo ($insumo->getNom_ins()); ?>" type="text" id="nom_ins" name="nom_ins">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Descripcion" value="<?php echo ($insumo->getDscr()); ?>" type="text" id="dscr" name="dscr">
                    </div>
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Cantidad (sacos, cajas, etc)" value="<?php echo ($insumo->getBloque()); ?>" type="text" id="bloque" name="bloque">
                    </div>
                    <label for="uni_bloque">Unidad de Bloque</label>
                    <select class="select-field" name="uni_bloque" id="uni_bloque">
                        <option value="sacos" <?php echo $insumo->getUni_bloque() === 'sacos' ? 'selected' : ''; ?>>sacos</option>
                        <option value="paquetes" <?php echo $insumo->getUni_bloque() === 'paquetes' ? 'selected' : ''; ?>>paquetes</option>
                        <option value="cajas" <?php echo $insumo->getUni_bloque() === 'cajas' ? 'selected' : ''; ?>>cajas</option>
                    </select>
                    <label for="packExist">¿Contiene Unidades?</label>
                    <input class="check" <?php if(!empty($insumo->getPack())){echo('checked');} ?> type="checkbox" name="packExist" id="packExist">
                    
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Cantidad de unidades" value="<?php echo ($insumo->getPack()); ?>" type="text" id="pack" name="pack">
                    </div>
                    
                    <label for="uni_pack">Unidad del Paquete</label>
                    <select class="select-field" name="uni_pack" id="uni_pack">
                        <option value="unid" <?php echo $insumo->getUni_pack() === 'unid' ? 'selected' : ''; ?>>unid</option>
                    </select>
                    
                    <div class="input-wrapper">
                        <input class="input-field" placeholder="Peso individual" value="<?php echo ($insumo->getPeso_ind()); ?>" type="text" id="peso_ind" name="peso_ind">
                    </div>
                    
                    <label for="uni_med">Medida</label>
                    <select class="select-field" name="uni_med" id="uni_med">
                        <option value="kg" <?php echo $insumo->getUni_med() === 'kg' ? 'selected' : ''; ?>>kg</option>
                        <option value="lt" <?php echo $insumo->getUni_med() === 'lt' ? 'selected' : ''; ?>>lt</option>
                        <option value="unid" <?php echo $insumo->getUni_med() === 'unid' ? 'selected' : ''; ?>>unid</option>
                    </select>
                    
                    <button class="create-button" type="submit" name="action" value="update">ACTUALIZAR</button>
                    
                    <input type="hidden" value="<?php echo ($insumo->getCod_ins()); ?>" id="id" name="id">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
