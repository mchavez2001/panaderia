<?php
class Categoria{
    private $cod_categoria;
    private $nom_categoria;
    private $dscr;

    public function __construct($nom_categoria, $dscr) {
        $this->nom_categoria = $nom_categoria;
        $this->dscr = $dscr;
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

    public function getNom_categoria()
    {
        return $this->nom_categoria;
    }

    public function setNom_categoria($nom_categoria)
    {
        $this->nom_categoria = $nom_categoria;

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
}
?>