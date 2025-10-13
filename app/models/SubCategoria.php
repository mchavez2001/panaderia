<?php
class SubCategoria{
    private $cod_subcategoria;
    private $cod_categoria;
    private $nom_subcategoria;

    public function __construct($cod_categoria, $nom_subcategoria) {
        $this->cod_categoria = $cod_categoria;
        $this->nom_subcategoria = $nom_subcategoria;
    }
    

    /**
     * Get the value of cod_subcategoria
     */ 
    public function getCod_subcategoria()
    {
        return $this->cod_subcategoria;
    }

    /**
     * Set the value of cod_subcategoria
     *
     * @return  self
     */ 
    public function setCod_subcategoria($cod_subcategoria)
    {
        $this->cod_subcategoria = $cod_subcategoria;

        return $this;
    }

    /**
     * Get the value of cod_categoria
     */ 
    public function getCod_categoria()
    {
        return $this->cod_categoria;
    }

    /**
     * Set the value of cod_categoria
     *
     * @return  self
     */ 
    public function setCod_categoria($cod_categoria)
    {
        $this->cod_categoria = $cod_categoria;

        return $this;
    }

    /**
     * Get the value of nom_subcategoria
     */ 
    public function getNom_subcategoria()
    {
        return $this->nom_subcategoria;
    }

    /**
     * Set the value of nom_subcategoria
     *
     * @return  self
     */ 
    public function setNom_subcategoria($nom_subcategoria)
    {
        $this->nom_subcategoria = $nom_subcategoria;

        return $this;
    }
}
?>