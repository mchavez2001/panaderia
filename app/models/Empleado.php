<?php

class Empleado
{
    private $id_empleado;
    private $user;
    private $clave;
    private $nombre;
    private $apellido;
    private $rol;
    private $estado;
    private $email;

    public function __construct($user, $clave, $nombre, $apellido, $rol, $estado, $email)
    {
        $this->user = $user;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->rol = $rol;
        $this->estado = $estado;
        $this->email = $email;
    }

    public function getId_empleado()
    {
        return $this->id_empleado;
    }

    public function setId_empleado($id_empleado){
        $this->id_empleado = $id_empleado;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }


    public function getClave()
    {
        return $this->clave;
    }

    public function setClave($clave){
        $this->clave = $clave;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }
}
