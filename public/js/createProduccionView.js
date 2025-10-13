function actualizarTamanos() {
    const selectProducto = document.getElementById('nombre');
    const selectTamano = document.getElementById('tamano');
    const productoSeleccionado = selectProducto.value;
    var tamanos = ['Grande', 'Mediano', 'Pequeño'];
    // Limpiar las opciones actuales del select de tamaños
    selectTamano.innerHTML = '';

    // Encontrar los tamaños disponibles para el producto seleccionado
    if (productoSeleccionado == 'Pan') {
        for (let i = 0; i < tamanos.length; i++) {
            const option = document.createElement('option');
            option.value = tamanos[i];
            option.text = tamanos[i];
            selectTamano.appendChild(option);
        }
    }else if(productoSeleccionado == 'Bizcocho'){
        for (let i = 0; i < tamanos.length; i++) {
            if(tamanos[i]!='Mediano'){
                const option = document.createElement('option');
                option.value = tamanos[i];
                option.text = tamanos[i];
                selectTamano.appendChild(option);
            }
        }
    }
}