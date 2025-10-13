<?php
class Categoria_Det{
    private $cod_categoria_det;
    private $cod_categoria;
    private $nom_categoria_det;
    private $level_det;
    private $total;

    public function __construct($cod_categoria, $nom_categoria_det, $level_det) {
        $this->cod_categoria = $cod_categoria;
        $this->nom_categoria_det = $nom_categoria_det;
        $this->level_det = $level_det;
    }

    public function getCod_categoria_det()
    {
        return $this->cod_categoria_det;
    }

    public function setCod_categoria_det($cod_categoria_det)
    {
        $this->cod_categoria_det = $cod_categoria_det;

        return $this;
    }

    public function getCod_categoria()
    {
        return $this->cod_categoria;
    }

    public function setCod_categoria($cod_categoria)
    {
        $this->cod_categoria = $cod_categoria;

        return $this;
    }

    public function getNom_categoria_det()
    {
        return $this->nom_categoria_det;
    }

    public function setNom_categoria_det($nom_categoria_det)
    {
        $this->nom_categoria_det = $nom_categoria_det;

        return $this;
    }

    public function getLevel_det()
    {
        return $this->level_det;
    }

    public function setLevel_det($level_det)
    {
        $this->level_det = $level_det;

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}

?>