<?php
class Cuenta{
    private $cod_cuenta;
    private $cod_cliente;
    private $saldo;
    private $estado;

    public function __construct($cod_cliente, $saldo, $estado) {
        $this->cod_cliente = $cod_cliente;
        $this->saldo = $saldo;
        $this->estado = $estado;
    }

    public function getCod_cuenta()
    {
        return $this->cod_cuenta;
    }

    public function setCod_cuenta($cod_cuenta)
    {
        $this->cod_cuenta = $cod_cuenta;

        return $this;
    }

    public function getCod_cliente()
    {
        return $this->cod_cliente;
    }

    public function setCod_cliente($cod_cliente)
    {
        $this->cod_cliente = $cod_cliente;

        return $this;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}


?>