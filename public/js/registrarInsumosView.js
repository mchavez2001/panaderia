$(document).ready(function () {
    $('.create').on('click', function () {
        $('#formContent').load('/panaderia/public/agregar_insumo');
    });

    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_insumo?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });
    $('.editkgprecio').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_insumo_precio?id=' + userId);
    });
});
