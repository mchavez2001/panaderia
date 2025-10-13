<?php
require_once __DIR__ . '/../dao/PetroleoDao.php';
require_once '../config/values_pretroleo.php';

class PetroleoController
{
    private $petroleoDao;
    private $datos_consumo;

    public function __construct()
    {
        $this->petroleoDao = new PetroleoDao();
        global $datos_consumo;
        $this->datos_consumo = $datos_consumo;
    }

    public function obtenerConsumosPetroleo()
    {
        return $this->petroleoDao->getConsumosPetroleo();
    }
    public function obtenerConsumoPetroleo($id)
    {
        return $this->petroleoDao->getConsumoPetroleo($id);
    }
    public function agregarConsumosPetroleo($consumo)
    {
        $this->petroleoDao->insertConsumo_Petroleo($consumo);
    }
    public function editarConsumosPetroleo($consumo)
    {
        $this->petroleoDao->editConsumo_Petroleo($consumo);
    }
    public function eliminarConsumoPetroleo($id)
    {
        $this->petroleoDao->deleteConsumo_Petroleo($id);
    }
    public function calcularGalones($altura)
    {
        $datos_consumo = $this->datos_consumo;
        $conversion_galon = 0.264172 / 1000;
        $galones = $datos_consumo['pi'] * pow($datos_consumo['radio'], 2) * $altura * $conversion_galon;
        return $galones;
    }
    public function calcularInversion($galones)
    {
        $datos_consumo = $this->datos_consumo;
        $inversion = $galones * $datos_consumo['costo_galon'];
        return $inversion;
    }
}
