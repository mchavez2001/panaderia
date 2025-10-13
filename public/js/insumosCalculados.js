$(document).ready(function () {
    $('#openModal').on('click', function () {
        // Cargar el contenido del formulario para agregar usuario
        $('#formContent').load('../app/views/createUsuarioView.php');
    });

    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_insumo_produccion?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });
});