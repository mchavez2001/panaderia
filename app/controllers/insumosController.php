<?php
require_once __DIR__ . '/../dao/InsumoDao.php';

class InsumoController
{
    private $insumoDao;

    public function __construct()
    {
        $this->insumoDao = new InsumoDao();
    }

    public function obtenerInsumosbyFecha()
    {
        return $this->insumoDao->getInsumosbyFecha();
    }
    public function agregarInsumoListaDelDia($nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stock, $precio, $precio_tot)
    {
        if($pack == 'S/D' && $uni_pack = 'S/D'){
            $stockFinal = $bloque * $peso_ind;
            $insumo = new Insumo($nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stockFinal, $precio, $precio_tot);
        }
        else{
            $stockFinal = $bloque * $pack * $peso_ind;
            $insumo = new Insumo($nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stockFinal, $precio, $precio_tot);
        }
        return $this->insumoDao->insertInsumoSinPrecio($insumo);
    }
    public function obtenerInsumosListaDelDia()
    {
        return $this->insumoDao->getInsumosSinPrecio();
    }
    public function editarInsumoListaDelDia($insumo)
    {
        if($insumo->getPack() == 'S/D' && $insumo->getUni_pack() == 'S/D'){
            $insumo->setStock($insumo->getBloque() * $insumo->getPeso_ind());
        }
        else{
            $insumo->setStock($insumo->getBloque() * $insumo->getPack() * $insumo->getPeso_ind());
        }
        return $this->insumoDao->updateInsumoSinPrecio($insumo);
    }
    public function eliminarInsumoListaDelDia($id)
    {
        return $this->insumoDao->deleteInsumoSinPrecio($id);
    }
    public function obtenerInsumoListaDelDiaByID($id)
    {
        $data = $this->insumoDao->findInsumoByID($id);
        $insumo = new Insumo($data['nom_ins'], $data['dscr'], $data['bloque'], $data['uni_bloque'], $data['pack'], $data['uni_pack'], $data['peso_ind'], $data['uni_med'], $data['stock'], $data['precio'], $data['precio_tot']);
        return $insumo;
    }
    public function actualizarPrecioInsumo($insumo){
        return $this->insumoDao->updatePrecioInsumo($insumo);
    }
    public function guardarInventarioInsumos(){
        $insumosOld = $this->insumoDao->getInsumosbyFecha();
        $insumosNew = $this->insumoDao->getInsumosSinPrecio();
        return $this->insumoDao->createNewInvInsumo($insumosOld, $insumosNew);
    }

    public function obtenerInsumosEntreFecha($fchini, $fchfin)
    {
        return $this->insumoDao->getInsumosbyFechaIndicada($fchini, $fchfin);
    }
    public function obtenerRecursos()
    {
        return $this->insumoDao->getRecursos();
    }
}
