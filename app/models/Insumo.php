<?php
class Insumo
{
    private $cod_ins;
    private $nom_ins;
    private $dscr;
    private $bloque;
    private $uni_bloque;
    private $pack;
    private $uni_pack;
    private $peso_ind;
    private $uni_med;
    private $stock; #Total (saco*peso_ind)
    private $precio;
    private $precio_tot;

    public function __construct($nom_ins, $dscr, $bloque, $uni_bloque, $pack, $uni_pack, $peso_ind, $uni_med, $stock, $precio, $precio_tot)
    {
        $this->nom_ins = $nom_ins;
        $this->dscr = $dscr;
        $this->bloque = $bloque;
        $this->uni_bloque = $uni_bloque;
        $this->pack = $pack;
        $this->uni_pack = $uni_pack;
        $this->peso_ind = $peso_ind;
        $this->uni_med = $uni_med;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->precio_tot = $precio_tot;
    }

    public function getCod_ins()
    {
        return $this->cod_ins;
    }

    public function setCod_ins($cod_ins)
    {
        $this->cod_ins = $cod_ins;

        return $this;
    }

    public function getNom_ins()
    {
        return $this->nom_ins;
    }

    public function setNom_ins($nom_ins)
    {
        $this->nom_ins = $nom_ins;

        return $this;
    }

    public function getDscr()
    {
        return $this->dscr;
    }

    public function setDscr($dscr)
    {
        $this->dscr = $dscr;

        return $this;
    }

    public function getBloque()
    {
        return $this->bloque;
    }

    public function setBloque($bloque)
    {
        $this->bloque = $bloque;

        return $this;
    }

    public function getUni_bloque()
    {
        return $this->uni_bloque;
    }

    public function setUni_bloque($uni_bloque)
    {
        $this->uni_bloque = $uni_bloque;

        return $this;
    }

    public function getPack()
    {
        return $this->pack;
    }

    public function setPack($pack)
    {
        $this->pack = $pack;

        return $this;
    }

    public function getUni_pack()
    {
        return $this->uni_pack;
    }

    public function setUni_pack($uni_pack)
    {
        $this->uni_pack = $uni_pack;

        return $this;
    }
    public function getPeso_ind()
    {
        return $this->peso_ind;
    }

    public function setPeso_ind($peso_ind)
    {
        $this->peso_ind = $peso_ind;

        return $this;
    }
    public function getUni_med()
    {
        return $this->uni_med;
    }

    public function setUni_med($uni_med)
    {
        $this->uni_med = $uni_med;

        return $this;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }


    public function getPrecio_tot()
    {
        return $this->precio_tot;
    }

    public function setPrecio_tot($precio_tot)
    {
        $this->precio_tot = $precio_tot;

        return $this;
    }
}
