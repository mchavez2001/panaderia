<?php
class Pedido{
    private $cod_pedido;
    private $cod_venta;
    private $dscr;
    private $fech_reg;
    private $fech_ped;
    private $estado;
    
    public function __construct($cod_venta, $dscr, $fech_reg, $fech_ped, $estado) {
        $this->cod_venta = $cod_venta;
        $this->dscr = $dscr;
        $this->fech_reg = $fech_reg;
        $this->fech_ped = $fech_ped;
        $this->estado = $estado;
    }

    /**
     * Get the value of cod_pedido
     */ 
    public function getCod_pedido()
    {
        return $this->cod_pedido;
    }

    /**
     * Set the value of cod_pedido
     *
     * @return  self
     */ 
    public function setCod_pedido($cod_pedido)
    {
        $this->cod_pedido = $cod_pedido;

        return $this;
    }

    /**
     * Get the value of cod_venta
     */ 
    public function getCod_venta()
    {
        return $this->cod_venta;
    }

    /**
     * Set the value of cod_venta
     *
     * @return  self
     */ 
    public function setCod_venta($cod_venta)
    {
        $this->cod_venta = $cod_venta;

        return $this;
    }

    /**
     * Get the value of dscr
     */ 
    public function getDscr()
    {
        return $this->dscr;
    }

    /**
     * Set the value of dscr
     *
     * @return  self
     */ 
    public function setDscr($dscr)
    {
        $this->dscr = $dscr;

        return $this;
    }

    /**
     * Get the value of fech_reg
     */ 
    public function getFech_reg()
    {
        return $this->fech_reg;
    }

    /**
     * Set the value of fech_reg
     *
     * @return  self
     */ 
    public function setFech_reg($fech_reg)
    {
        $this->fech_reg = $fech_reg;

        return $this;
    }

    /**
     * Get the value of fech_ped
     */ 
    public function getFech_ped()
    {
        return $this->fech_ped;
    }

    /**
     * Set the value of fech_ped
     *
     * @return  self
     */ 
    public function setFech_ped($fech_ped)
    {
        $this->fech_ped = $fech_ped;

        return $this;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
?>