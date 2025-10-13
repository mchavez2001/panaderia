/* // Obtenemos todos los productos de PHP en un array de objetos
const productos = <? php echo json_encode($productos); ?>; */

/* if (productos) {
    console.log('Existe');
}
productos.forEach(producto => {
    console.log(producto.nom_prod);
    console.log(producto.tam_prod);
    console.log(producto.cant_prod);
}); */
function actualizarTamanosYMaxBolsas() {
    const selectProducto = document.getElementById('nombre');
    const selectTamano = document.getElementById('tamano');
    const productoSeleccionado = selectProducto.value;

    // Limpiar las opciones actuales del select de tamaños
    selectTamano.innerHTML = '';

    // Encontrar los tamaños disponibles para el producto seleccionado
    productos.forEach(producto => {
        if (producto.nom_prod === productoSeleccionado) {
            const option = document.createElement('option');
            option.value = producto.tam_prod;
            option.text = producto.tam_prod;
            selectTamano.appendChild(option);
        }
    });

    // Actualizar el máximo de bolsas
    actualizarMaxBolsas();
}

function actualizarMaxBolsas() {
    const selectTamano = document.getElementById('tamano');
    const tamanoSeleccionado = selectTamano.value;
    const selectProducto = document.getElementById('nombre');
    const productoSeleccionado = selectProducto.value;
    const inputCant = document.getElementById('cant');
    const inputPrecio = document.getElementById('precio');

    // Encontrar el producto y calcular el máximo de bolsas
    productos.forEach(producto => {
        if (producto.nom_prod === productoSeleccionado && producto.tam_prod === tamanoSeleccionado) {
            let maxBolsas;
            switch (tamanoSeleccionado) {
                case 'Pequeño':
                    maxBolsas = Math.floor(producto.cant_prod / 42);
                    break;
                case 'Mediano':
                    maxBolsas = Math.floor(producto.cant_prod / 21);
                    break;
                case 'Grande':
                    maxBolsas = Math.floor(producto.cant_prod / 18);
                    break;
            }
            inputCant.max = maxBolsas;
            inputPrecio.value = producto.precio;
        }
    });
}

// Inicializar los tamaños y el máximo de bolsas al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    actualizarTamanosYMaxBolsas();
});