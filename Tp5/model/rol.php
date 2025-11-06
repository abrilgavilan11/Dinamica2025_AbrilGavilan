<?php
include_once('conector/baseDeDatos.php');

class Rol{
    private $idrol;
    private $roldescripcion;
    private static $mensajeoperacion;

    // Constructor
    public function __construct(){
        $this->idrol = "";
        $this->roldescripcion = "";
        self::$mensajeoperacion = "";
    }

    // Cargar
    public function cargar($idrol, $roldescripcion){
        $this->setIdrol($idrol);
        $this->setRoldescripcion($roldescripcion);
    }

    // Getters
    public function getIdrol(){
        return $this->idrol;
    }

    public function getRoldescripcion(){
        return $this->roldescripcion;
    }

    public static function getMensajeoperacion(){
        return self::$mensajeoperacion;
    }

    // Setters
    public function setIdrol($idrol): void{
        $this->idrol = $idrol;
    }

    public function setRoldescripcion($roldescripcion): void{
        $this->roldescripcion = $roldescripcion;
    }

    public static function setMensajeoperacion($mensajeoperacion): void{
        self::$mensajeoperacion = $mensajeoperacion;
    }

    // Buscar:
    // -> Esta funcion busca un rol por su idrol y carga los datos en el objeto
    public function buscar($idrol){
        $base = new BaseDatos();
        $consulta = "SELECT * FROM rol WHERE idrol = " . $idrol;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row = $base->Registro()) {
                    $this->cargar($row['idrol'], $row['roldescripcion']);
                    $resp = true;
                }
            } else {
                self::setMensajeoperacion($base->getError());
            }
        } else {
            self::setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    // Listar:
    // -> Esta funcion lista los roles que cumplen con una condicion dada
    public static function listar($condicion = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $consulta = "SELECT * FROM rol";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY idrol ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                while ($row = $base->Registro()) {
                    $obj = new Rol();
                    $obj->cargar($row['idrol'], $row['roldescripcion']);
                    array_push($arreglo, $obj);
                }
            } else {
                self::setMensajeoperacion($base->getError());
            }
        } else {
            self::setMensajeoperacion($base->getError());
        }
        return $arreglo;
    }

    // Insertar:
    // -> Esta funcion inserta un nuevo rol en la base de datos
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consulta = "INSERT INTO rol(roldescripcion) VALUES ('" . $this->getRoldescripcion() . "')";
        if ($base->Iniciar()) {
            if ($id = $base->Ejecutar($consulta)) {
                $this->setIdrol($id);
                $resp = true;
            } else {
                self::setMensajeoperacion($base->getError());
            }
        } else {
            self::setMensajeoperacion($base->getError());
        }
        return $resp;
    }
    
    // Modificar:
    // -> Esta funcion modifica los datos de un rol en la base de datos
    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $consulta = "UPDATE rol SET roldescripcion='" . $this->getRoldescripcion() . "' WHERE idrol=" . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                self::setMensajeoperacion($base->getError());
            }
        } else {
            self::setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    // Eliminar:
    // -> Esta funcion elimina un rol de la base de datos
    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();
        $consulta = "DELETE FROM rol WHERE idrol=" . $this->getIdrol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $resp = true;
            } else {
                self::setMensajeoperacion($base->getError());
            }
        } else {
            self::setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    // ToString:
    // -> Esta funcion devuelve una cadena con los datos del objeto
    public function __toString()
    {
        return "Rol ID: " . $this->getIdrol() . " - Descripción: " . $this->getRoldescripcion();
    }
}
?>