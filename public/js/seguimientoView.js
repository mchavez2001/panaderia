$(document).ready(function () {
    $('.edit').on('click', function () {
        var userId = $(this).data('id');
        $('#msgID').val(userId); // Asignar el ID al campo oculto del modal
    });
});