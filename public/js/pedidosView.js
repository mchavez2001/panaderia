$(document).ready(function () {
    $('.create').on('click', function () {
        // Cargar el contenido del formulario para agregar usuario
        $('#formContent').load('/panaderia/public/agregar_pedido');
    });
    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_pedido?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });
});