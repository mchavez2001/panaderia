<?php
require_once __DIR__ . '/../dao/ProduccionDao.php';
require_once '../config/values_procc.php';

class ProduccionController
{
    private $produccionDao;
    private $cantForPan;
    private $cantForBiz;

    public function __construct()
    {
        $this->produccionDao = new ProduccionDao();
        global $cantForPan;
        global $cantForBiz;
        $this->cantForPan = $cantForPan;
        $this->cantForBiz = $cantForBiz;
    }

    public function obtenerCochesProduccion()
    {
        return $this->produccionDao->getCocheForProduction();
    }

    public function obtenerCoche($id)
    {
        return $this->produccionDao->getCoche($id);
    }

    public function agregarCoche($producto)
    {
        return $this->produccionDao->insertCoche($producto);
    }

    public function editarCoche($producto)
    {
        return $this->produccionDao->editCoche($producto);
    }

    public function eliminarCoche($id)
    {
        $this->produccionDao->deleteCoche($id);
    }

    public function obtenerProductosProduccionporCoches($id)
    {
        return $this->produccionDao->getProductosForProductionbyCoches($id);
    }

    public function obtenerProductosProduccion()
    {
        return $this->produccionDao->getProductosForProduction();
    }

    public function obtenerProduccionbyID($id)
    {
        return $this->produccionDao->getProductionbyID($id);
    }
    public function agregarProduccion($cod_coche, $produccion, $producto)
    {
        return $this->produccionDao->insertProduccion($cod_coche, $produccion, $producto);
    }
    public function eliminarProduccionByID($cod_coche,$id)
    {
        $this->produccionDao->deleteProduccion($cod_coche,$id);
    }
    public function obtenerInsumosConsumidos()
    {
        return $this->produccionDao->getInsumosConsumidosinProduccion();
    }
    public function obtenerCantidadProductobyVenta()
    {
        return $this->produccionDao->getCantProductosbyVentas();
    }
    public function obtenerCantidadProductobyProduccion()
    {
        return $this->produccionDao->getCantProductosbyProduccion();
    }
    #Produccion en base a cantidad de bolsas
    public function calcularInsumosTemporales($produccion)
    {
        $cantInsPan = $this->cantForPan;
        $cantInsBiz = $this->cantForBiz;
        $namesInsPan = array_keys($cantInsPan);
        $cantBolsas = $produccion->getCant_prod();
        $cantExtra = $produccion->getCant_extra();
        $insumos = [];
        for ($i = 0; $i < count($cantInsPan); $i++) {
            switch ($produccion->getNom_prod()) {
                case 'Pan':
                    switch ($produccion->getTam_prod()) {
                        case 'Pequeño':
                            $cantPan = $cantBolsas * 42 + $cantExtra;
                            #3,466
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 42), 2), '', '');
                            break;
                        case 'Mediano':
                            $cantPan = $cantBolsas * 21 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 21), 2), '', '');
                            break;
                        case 'Grande':
                            $cantPan = $cantBolsas * 18 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 18), 2), '', '');
                            break;
                    }
                    break;
                case 'Bizcocho':
                    switch ($produccion->getTam_prod()) {
                        case 'Pequeño':
                            $cantBiz = $cantBolsas * 42 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsBiz[$namesInsPan[$i]] * $cantBiz / (18.57 * 42), 2), '', '');
                            break;
                        case 'Grande':
                            $cantBiz = $cantBolsas * 18 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsBiz[$namesInsPan[$i]] * $cantBiz / (18.57 * 18), 2), '', '');
                            break;
                    }
                    break;
            }
            $insumos[] = $insumo;
        }
        return $insumos;
    }

    public function calcularInsumosRequeridos($produccion)
    {
        $cantInsPan = $this->cantForPan;
        $cantInsBiz = $this->cantForBiz;
        $namesInsPan = array_keys($cantInsPan);
        $cantBolsas = $produccion->getCant_prod();
        $cantExtra = $produccion->getCant_extra();
        for ($i = 0; $i < count($cantInsPan); $i++) {
            switch ($produccion->getNom_prod()) {
                case 'Pan':
                    switch ($produccion->getTam_prod()) {
                        case 'Pequeño':
                            $cantPan = $cantBolsas * 42 + $cantExtra;
                            #3,466
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 42), 2), '', '');
                            #print_r($insumo);
                            $this->produccionDao->insertInsToProcc($produccion->getCod_prod(), $insumo);
                            break;
                        case 'Mediano':
                            $cantPan = $cantBolsas * 21 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 21), 2), '', '');
                            #print_r($insumo);
                            $this->produccionDao->insertInsToProcc($produccion->getCod_prod(), $insumo);
                            break;
                        case 'Grande':
                            $cantPan = $cantBolsas * 18 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsPan[$namesInsPan[$i]] * $cantPan / (16.67 * 18), 2), '', '');
                            #print_r($insumo);
                            $this->produccionDao->insertInsToProcc($produccion->getCod_prod(), $insumo);
                            break;
                    }
                    break;
                case 'Bizcocho':
                    switch ($produccion->getTam_prod()) {
                        case 'Pequeño':
                            $cantBiz = $cantBolsas * 42 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsBiz[$namesInsPan[$i]] * $cantBiz / (18.57 * 42), 2), '', '');
                            #print_r($insumo);
                            $this->produccionDao->insertInsToProcc($produccion->getCod_prod(), $insumo);
                            break;
                        case 'Grande':
                            $cantBiz = $cantBolsas * 18 + $cantExtra;
                            $insumo = new Insumo($namesInsPan[$i], '', '', '', '', '', '', 'gr', round($cantInsBiz[$namesInsPan[$i]] * $cantBiz / (18.57 * 18), 2), '', '');
                            #print_r($insumo);
                            $this->produccionDao->insertInsToProcc($produccion->getCod_prod(), $insumo);
                            break;
                    }
                    break;
            }
        }
    }
    public function obtenerInsumosProduccion()
    {
        return $this->produccionDao->getInsumosForProduction();
    }

    public function obtenerInsumoProduccionByID($id)
    {
        $data = $this->produccionDao->findInsumoProduccionByID($id);
        $insumo = new Insumo($data['nom_ins'], $data['dscr'], $data['bloque'], $data['uni_bloque'], $data['pack'], $data['uni_pack'], $data['peso_ind'], $data['uni_med'], $data['stock'], $data['precio'], $data['precio_tot']);
        return $insumo;
    }

    public function eliminarInsumoProduccionByID($id)
    {
        $this->produccionDao->deleteInsumoProduccion($id);
    }
    public function actualizarStockInsumoProduccion($insumo)
    {
        $this->produccionDao->updateStockInsumoProduccion($insumo);
    }
    public function obtenerInventarioInsumos()
    {
        return $this->produccionDao->getInventarioInsumos();
    }
    public function descontarInsumosProduccion($insumoInventario, $insumoProduccion)
    {
        #print_r($insumoInventario);
        /* foreach ($insumoInventario as $insumo) {
            echo ($insumo->getNom_ins() . ' ' . $insumo->getStock() . ' ' . $insumo->getUni_med() . '<br>');
        }
        echo ('<br>');
        foreach ($insumoProduccion as $insumo) {
            echo ($insumo->getNom_ins() . ' ' . $insumo->getStock() . ' ' . $insumo->getUni_med() . '<br>');
        } */
        $insumoHarina = new Insumo('Harina', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoAzucar = new Insumo('Azucar', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoSal = new Insumo('Sal', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoMejorador = new Insumo('Mejorador', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoLevadura = new Insumo('Levadura', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoManteca = new Insumo('Manteca', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoAceite = new Insumo('Aceite', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');

        $insumoLeche = new Insumo('Leche', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoEscencia = new Insumo('Escencia', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');
        $insumoAnis = new Insumo('Anis', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'S/D', 'gr', 0, 'S/D', 'S/D');

        $insumosProduccionTotal = [$insumoHarina, $insumoAzucar, $insumoManteca, $insumoLevadura, $insumoMejorador, $insumoSal, $insumoAceite, $insumoLeche, $insumoEscencia, $insumoAnis];
        foreach ($insumoProduccion as $insumo) {
            switch ($insumo->getNom_ins()) {
                case 'Harina':
                    $insumoHarina->setStock($insumoHarina->getStock() + $insumo->getStock());
                    break;
                case 'Azucar':
                    $insumoAzucar->setStock($insumoAzucar->getStock() + $insumo->getStock());
                    break;
                case 'Sal':
                    $insumoSal->setStock($insumoSal->getStock() + $insumo->getStock());
                    break;
                case 'Mejorador':
                    $insumoMejorador->setStock($insumoMejorador->getStock() + $insumo->getStock());
                    break;
                case 'Levadura':
                    $insumoLevadura->setStock($insumoLevadura->getStock() + $insumo->getStock());
                    break;
                case 'Manteca':
                    $insumoManteca->setStock($insumoManteca->getStock() + $insumo->getStock());
                    break;
                case 'Manteca_Engrasar':
                    $insumoManteca->setStock($insumoManteca->getStock() + $insumo->getStock());
                    break;
                case 'Aceite':
                    $insumoAceite->setStock($insumoAceite->getStock() + $insumo->getStock());
                    break;
                case 'Leche':
                    $insumoLeche->setStock($insumoLeche->getStock() + $insumo->getStock());
                    break;
                case 'Escencia':
                    $insumoEscencia->setStock($insumoEscencia->getStock() + $insumo->getStock());
                    break;
                case 'Anis':
                    $insumoAnis->setStock($insumoAnis->getStock() + $insumo->getStock());
                    break;
            }
        }
        /* echo ('<br>InsumoConteo<br>');
        echo ($insumoHarina->getNom_ins() . ' ' . $insumoHarina->getStock() . ' ' . $insumoHarina->getUni_med() . '<br>');
        echo ($insumoAzucar->getNom_ins() . ' ' . $insumoAzucar->getStock() . ' ' . $insumoAzucar->getUni_med() . '<br>');
        echo ($insumoSal->getNom_ins() . ' ' . $insumoSal->getStock() . ' ' . $insumoSal->getUni_med() . '<br>');
        echo ($insumoMejorador->getNom_ins() . ' ' . $insumoMejorador->getStock() . ' ' . $insumoMejorador->getUni_med() . '<br>');
        echo ($insumoLevadura->getNom_ins() . ' ' . $insumoLevadura->getStock() . ' ' . $insumoLevadura->getUni_med() . '<br>');
        echo ($insumoManteca->getNom_ins() . ' ' . $insumoManteca->getStock() . ' ' . $insumoManteca->getUni_med() . '<br>');
        echo ($insumoAceite->getNom_ins() . ' ' . $insumoAceite->getStock() . ' ' . $insumoAceite->getUni_med() . '<br>'); */
        foreach ($insumoInventario as $insumo) {
            switch ($insumo->getNom_ins()) {
                case 'Harina':
                    $insumoHarina->setStock($insumo->getStock() - $insumoHarina->getStock()/1000);
                    $insumoHarina->setUni_med($insumo->getUni_med());
                    $insumoHarina->setDscr($insumo->getDscr());
                    $insumoHarina->setPrecio($insumo->getPrecio());
                    $insumoHarina->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Azucar':
                    $insumoAzucar->setStock($insumo->getStock() - $insumoAzucar->getStock()/1000);
                    $insumoAzucar->setUni_med($insumo->getUni_med());
                    $insumoAzucar->setDscr($insumo->getDscr());
                    $insumoAzucar->setPrecio($insumo->getPrecio());
                    $insumoAzucar->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Sal':
                    $insumoSal->setStock($insumo->getStock() - $insumoSal->getStock()/1000);
                    $insumoSal->setUni_med($insumo->getUni_med());
                    $insumoSal->setDscr($insumo->getDscr());
                    $insumoSal->setPrecio($insumo->getPrecio());
                    $insumoSal->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Mejorador':
                    $insumoMejorador->setStock($insumo->getStock() - $insumoMejorador->getStock()/1000);
                    $insumoMejorador->setUni_med($insumo->getUni_med());
                    $insumoMejorador->setDscr($insumo->getDscr());
                    $insumoMejorador->setPrecio($insumo->getPrecio());
                    $insumoMejorador->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Levadura':
                    $insumoLevadura->setStock($insumo->getStock() - $insumoLevadura->getStock()/1000);
                    $insumoLevadura->setUni_med($insumo->getUni_med());
                    $insumoLevadura->setDscr($insumo->getDscr());
                    $insumoLevadura->setPrecio($insumo->getPrecio());
                    $insumoLevadura->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Manteca':
                    $insumoManteca->setStock($insumo->getStock() - $insumoManteca->getStock()/1000);
                    $insumoManteca->setUni_med($insumo->getUni_med());
                    $insumoManteca->setDscr($insumo->getDscr());
                    $insumoManteca->setPrecio($insumo->getPrecio());
                    $insumoManteca->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Manteca_Engrasar':
                    $insumoManteca->setStock($insumo->getStock() - $insumoManteca->getStock()/1000);
                    break;
                case 'Aceite':
                    $insumoAceite->setStock($insumo->getStock() - $insumoAceite->getStock()/1000);
                    $insumoAceite->setUni_med($insumo->getUni_med());
                    $insumoAceite->setDscr($insumo->getDscr());
                    $insumoAceite->setPrecio($insumo->getPrecio());
                    $insumoAceite->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Leche':
                    $insumoLeche->setStock($insumo->getStock() - $insumoLeche->getStock()/1000);
                    $insumoLeche->setUni_med($insumo->getUni_med());
                    $insumoLeche->setDscr($insumo->getDscr());
                    $insumoLeche->setPrecio($insumo->getPrecio());
                    $insumoLeche->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Escencia':
                    $insumoEscencia->setStock($insumo->getStock() - $insumoEscencia->getStock()/1000);
                    $insumoEscencia->setUni_med($insumo->getUni_med());
                    $insumoEscencia->setDscr($insumo->getDscr());
                    $insumoEscencia->setPrecio($insumo->getPrecio());
                    $insumoEscencia->setPrecio_tot($insumo->getPrecio_tot());
                    break;
                case 'Anis':
                    $insumoAnis->setStock($insumo->getStock() - $insumoAnis->getStock()/1000);
                    $insumoAnis->setUni_med($insumo->getUni_med());
                    $insumoAnis->setDscr($insumo->getDscr());
                    $insumoAnis->setPrecio($insumo->getPrecio());
                    $insumoAnis->setPrecio_tot($insumo->getPrecio_tot());
                    break;
            }
        }
        /* echo ('<br>InsumosFinales<br>');
        echo ($insumoHarina->getNom_ins() . ' ' . $insumoHarina->getStock() . ' ' . $insumoHarina->getUni_med() . '<br>');
        echo ($insumoAzucar->getNom_ins() . ' ' . $insumoAzucar->getStock() . ' ' . $insumoAzucar->getUni_med() . '<br>');
        echo ($insumoSal->getNom_ins() . ' ' . $insumoSal->getStock() . ' ' . $insumoSal->getUni_med() . '<br>');
        echo ($insumoMejorador->getNom_ins() . ' ' . $insumoMejorador->getStock() . ' ' . $insumoMejorador->getUni_med() . '<br>');
        echo ($insumoLevadura->getNom_ins() . ' ' . $insumoLevadura->getStock() . ' ' . $insumoLevadura->getUni_med() . '<br>');
        echo ($insumoManteca->getNom_ins() . ' ' . $insumoManteca->getStock() . ' ' . $insumoManteca->getUni_med() . '<br>');
        echo ($insumoAceite->getNom_ins() . ' ' . $insumoAceite->getStock() . ' ' . $insumoAceite->getUni_med() . '<br>'); */
        $cod_inv_ins = $this->produccionDao->createInvInsumo();
        foreach ($insumosProduccionTotal as $insumo) {
            $this->produccionDao->sendInsumoToInv($cod_inv_ins, $insumo);
        }
    }
    public function actualizarEstadoProducciones($id)
    {
        $this->produccionDao->updateEstadoProductionFinish($id);
    }
    public function crearInventarioProductos()
    {
        return $this->produccionDao->createInvProducto();
    }
    public function enviarProductosInventario($cod_inv_producto, $producciones)
    {
        foreach ($producciones as $key => $producto) {
            $this->produccionDao->sendProductoToInv($cod_inv_producto, $producto);
        }
    }
}
