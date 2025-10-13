<!DOCTYPE html>
<html>

<head>
    <title>Inicio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<?php
require_once 'nav.php';
?>

<body>
    <h2 style="text-align: center; color:#888888; margin-top: 20px">PANIFICADORA DEL NORTE CH&C</h2>
    <h2 style="text-align: center; color:#888888; margin-top: 20px">Bienvenido al sistema</h2>
    <div id="grafico-insumos" style="width: 100%; max-width: 1000px; height: auto; margin: 20px auto;"></div>
    <div id="grafico-productos" style="width: 100%; max-width: 1000px; height: auto; margin: 20px auto;"></div>
    <div id="grafico-productos_produccion" style="width: 100%; max-width: 1000px; height: auto; margin: 20px auto;"></div>

    <script>
        // Aquí tu variable PHP en JS
        const insumos = <?php echo $jsonData_insumos; ?>;

        // Agrupar por nombre
        const fechas = [...new Set(insumos.map(i => i.fecha))]; // Fechas únicas
        const insumosPorNombre = {};

        insumos.forEach(i => {
            if (!insumosPorNombre[i.nombre]) {
                insumosPorNombre[i.nombre] = {
                    x: [],
                    y: []
                };
            }
            insumosPorNombre[i.nombre].x.push(i.fecha);
            insumosPorNombre[i.nombre].y.push(parseFloat(i.stock));
        });

        const trazas = Object.keys(insumosPorNombre).map(nombre => ({
            x: insumosPorNombre[nombre].x,
            y: insumosPorNombre[nombre].y,
            type: 'scatter',
            mode: 'lines+markers',
            name: nombre
        }));

        const layout = {
            title: {
                text: 'Consumo de insumos por fechas de producción',
                font: {
                    size: 16
                },
                y: 0.9
            },
            xaxis: {
                title: 'Fecha',

            },
            yaxis: {
                title: 'Stock (kg)',
            },
            legend: {
                orientation: "h",
                x: 0,
                y: -0.3,
                font: {
                    size: 10
                },
            },
            margin: {
                t: 100,
                b: 80
            },
        };

        Plotly.newPlot('grafico-insumos', trazas, layout, {
            responsive: true
        });


        //PRODUCTOS
        const productos = <?php echo $jsonData_productos; ?>;

        // Agrupar por tamaño
        const fechasProd = [...new Set(productos.map(p => p.fecha))]; // Fechas únicas
        const productosPorTamano = {};

        productos.forEach(p => {
            const clave = `${p.nombre} - ${p.tamano}`;
            if (!productosPorTamano[clave]) {
                productosPorTamano[clave] = {
                    x: [],
                    y: []
                };
            }
            productosPorTamano[clave].x.push(p.fecha);
            productosPorTamano[clave].y.push(parseFloat(p.cantidad));
        });

        const trazasProd = Object.keys(productosPorTamano).map(tam => ({
            x: productosPorTamano[tam].x,
            y: productosPorTamano[tam].y,
            type: 'bar',
            name: tam
        }));

        const layoutProd = {
            title: {
                text: 'Productos Vendidos por Fecha',
                font: {
                    size: 16
                },
                y: 0.9
            },
            barmode: 'group',
            xaxis: {
                title: 'Fecha',
            },
            yaxis: {
                title: 'Cantidad Vendida (Bolsas)',
            },
            legend: {
                orientation: "h",
                x: 0,
                y: -0.3,
                font: {
                    size: 10
                },
            },
            margin: {
                t: 100,
                b: 100
            },
        };

        Plotly.newPlot('grafico-productos', trazasProd, layoutProd, {
            responsive: true
        });

        window.addEventListener('resize', () => {
            Plotly.Plots.resize('grafico-insumos');
            Plotly.react('grafico-productos', trazasProd, layoutProd, {
                responsive: true
            });
        });

        //PRODUCTOS PRODUCCION
        const productos_produccion = <?php echo $jsonData_productos_produccion; ?>;

        // Agrupar por tamaño
        const fechasProd_produccion = [...new Set(productos_produccion.map(p => p.fecha))]; // Fechas únicas
        const productosProduccionPorTamano = {};

        productos_produccion.forEach(p => {
            const clave = `${p.nombre} - ${p.tamano}`;
            if (!productosProduccionPorTamano[clave]) {
                productosProduccionPorTamano[clave] = {
                    x: [],
                    y: []
                };
            }
            productosProduccionPorTamano[clave].x.push(p.fecha);
            productosProduccionPorTamano[clave].y.push(parseFloat(p.cantidad));
        });

        const trazasProd_Produccion = Object.keys(productosProduccionPorTamano).map(tam => ({
            x: productosProduccionPorTamano[tam].x,
            y: productosProduccionPorTamano[tam].y,
            type: 'bar',
            name: tam
        }));

        const layoutProd_Produccion = {
            title: {
                text: 'Productos Produccidos por Fecha',
                font: {
                    size: 16
                },
                y: 0.9
            },
            barmode: 'group',
            xaxis: {
                title: 'Fecha',
            },
            yaxis: {
                title: 'Cantidad Producida (Bolsas)',
            },
            legend: {
                orientation: "h",
                x: 0,
                y: -0.3,
                font: {
                    size: 10
                },
            },
            margin: {
                t: 100,
                b: 100
            },
        };

        Plotly.newPlot('grafico-productos_produccion', trazasProd_Produccion, layoutProd_Produccion, {
            responsive: true
        });

        window.addEventListener('resize', () => {
            Plotly.Plots.resize('grafico-insumos');
            Plotly.react('grafico-productos_produccion', trazasProd_Produccion, layoutProd_Produccion, {
                responsive: true
            });
        });
    </script>
</body>

</html>