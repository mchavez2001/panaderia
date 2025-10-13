$(document).ready(function () {
    /* $('#openModal').on('click', function () {
        // Cargar el contenido del formulario para agregar usuario
        $('#formContent').load('/panaderia/public/agregar_produccion');
    }); */

    $('.create').on('click', function () {
        // Cargar el contenido del formulario para agregar usuario
        $('#formContent').load('/panaderia/public/agregar_produccion');
    });

    $('.edit').on('click', function () {
        var userId = $(this).data('id'); // Obtiene el ID del usuario
        $('#formContent').load('/panaderia/public/editar_produccion?id=' + userId);
    });
    $('.calcular').on('click', function () {
        var userId = $(this).data('id');
        $('#formContent').load('/panaderia/public/calculo_temporal?id=' + userId);
    });
    $('.btn-delete').on('click', function () {
        var userId = $(this).data('id');
        $('#deleteUserId').val(userId); // Asignar el ID al campo oculto del modal
    });
});
