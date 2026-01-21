$(document).ready(function () {
    $('.create').on('click', function () {
        // Cargar el contenido del formulario para agregar usuario
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/agregar_producto_venta_abarrote?id=' + userId);
    });
    $('.productos').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/producto_venta_abarrote?id=' + userId);
    });
    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_producto_venta_abarrote?id=' + userId);
    });
    $('.addprod').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/agregar_producto_venta_abarrote?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });
});