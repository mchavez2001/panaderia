<!-- Modal Structure -->
<div class="modal fade" id="crearModal" tabindex="-1" aria-labelledby="crearUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal-lg para ancho más grande -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearUsuarioModalLabel" style="text-align: center;"></h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            <div class="modal-body">
                <!-- Aquí se carga el contenido del formulario -->
                <div id="formContent"></div>
            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div> -->
        </div>
    </div>
</div>
<?php #echo($rutaDelete); ?>
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este registro?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="/panaderia/public/<?php echo($rutaDelete); ?>" method="post">
                    <input type="hidden" name="id" id="deleteUserId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="eliminar" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Mensaje personalizado -->
<div class="modal fade" id="confirmMsgModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Alerta</h5>
            </div>
            <div class="modal-body">
                <?php echo($mensaje); ?>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="/panaderia/public/<?php echo($rutaMsg); ?>" method="post">
                    <input type="hidden" name="id" id="msgID">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="confirmar" class="btn btn-primary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>