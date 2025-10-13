<?php
class Recurso{
    private $cod_rec;
    private $cod_inv_rec;
    private $cant_rec;
    private $uni_med_rec;
    private $precio_rec_unit;
    private $precio_rec_tot;

    public function __construct($cod_inv_rec, $cant_rec, $uni_med_rec, $precio_rec_unit, $precio_rec_tot) {
        $this->cod_inv_rec = $cod_inv_rec;
        $this->cant_rec = $cant_rec;
        $this->uni_med_rec = $uni_med_rec;
        $this->precio_rec_unit = $precio_rec_unit;
        $this->precio_rec_tot = $precio_rec_tot;
    }

    /**
     * Get the value of cod_rec
     */ 
    public function getCod_rec()
    {
        return $this->cod_rec;
    }

    /**
     * Set the value of cod_rec
     *
     * @return  self
     */ 
    public function setCod_rec($cod_rec)
    {
        $this->cod_rec = $cod_rec;

        return $this;
    }

    /**
     * Get the value of cod_inv_rec
     */ 
    public function getCod_inv_rec()
    {
        return $this->cod_inv_rec;
    }

    /**
     * Set the value of cod_inv_rec
     *
     * @return  self
     */ 
    public function setCod_inv_rec($cod_inv_rec)
    {
        $this->cod_inv_rec = $cod_inv_rec;

        return $this;
    }

    /**
     * Get the value of cant_rec
     */ 
    public function getCant_rec()
    {
        return $this->cant_rec;
    }

    /**
     * Set the value of cant_rec
     *
     * @return  self
     */ 
    public function setCant_rec($cant_rec)
    {
        $this->cant_rec = $cant_rec;

        return $this;
    }

    /**
     * Get the value of uni_med_rec
     */ 
    public function getUni_med_rec()
    {
        return $this->uni_med_rec;
    }

    /**
     * Set the value of uni_med_rec
     *
     * @return  self
     */ 
    public function setUni_med_rec($uni_med_rec)
    {
        $this->uni_med_rec = $uni_med_rec;

        return $this;
    }

    /**
     * Get the value of precio_rec_unit
     */ 
    public function getPrecio_rec_unit()
    {
        return $this->precio_rec_unit;
    }

    /**
     * Set the value of precio_rec_unit
     *
     * @return  self
     */ 
    public function setPrecio_rec_unit($precio_rec_unit)
    {
        $this->precio_rec_unit = $precio_rec_unit;

        return $this;
    }

    /**
     * Get the value of precio_rec_tot
     */ 
    public function getPrecio_rec_tot()
    {
        return $this->precio_rec_tot;
    }

    /**
     * Set the value of precio_rec_tot
     *
     * @return  self
     */ 
    public function setPrecio_rec_tot($precio_rec_tot)
    {
        $this->precio_rec_tot = $precio_rec_tot;

        return $this;
    }
}
?>