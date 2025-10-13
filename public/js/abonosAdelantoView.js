$(document).ready(function () {
    $('.create').on('click', function () {
        var userId = $(this).data('id');
        $('#formContent').load('/panaderia/public/agregar_abono_adelanto?id=' + userId);
    });

    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_abono?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });

});
