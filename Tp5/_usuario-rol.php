<?php
include_once('conector/baseDeDatos.php');

class Usuariorol {
    private $idusuario;
    private $idrol;
    private static $mensajeoperacion;

    // Constructor
    public function __construct(){
        $this->idusuario = "";
        $this->idrol = "";
        self::$mensajeoperacion = "";
    }

    // Cargar
    public function cargar($idusuario, $idrol){
        $this->setIdusuario($idusuario);
        $this->setIdrol($idrol);
    }

    // Getters
    public function getIdusuario(){
        return $this->idusuario;
    }

    public function getIdrol(){
        return $this->idrol;
    }

    public static function getMensajeoperacion(){
        return self::$mensajeoperacion;
    }

    // Setters
    public function setIdusuario($idusuario): void{
        $this->idusuario = $idusuario;
    }

    public function setIdrol($idrol): void{
        $this->idrol = $idrol;
    }

    public static function setMensajeoperacion($mensajeoperacion): void{
        self::$mensajeoperacion = $mensajeoperacion;
    }

    // Buscar:
    // -> Esta funcion busca un rol por su idusuario y carga los datos en el objeto
    public function buscar($idusuario){
        $base = new BaseDatos();
        $consulta = "SELECT * FROM usuariorol WHERE idusuario = " . $idusuario;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row = $base->Registro()) {
                    $this->cargar($row['idusuario'], $row['idrol']);
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

    // Insertar:
    // -> Esta funcion inserta un nuevo rol segun el tipo de usuario en la base de datos
    public function insertar(){
        $base = new BaseDatos();
        $resp = false;
        $consulta = "INSERT INTO usuariorol(idusuario, idrol) VALUES (" . $this->getIdusuario() . ", " . $this->getIdrol() . ")";
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
    
    // Listar:
    // -> Esta funcion lista los roles que cumplen con una condicion dada
    public static function listar($condicion = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $consulta = "SELECT * FROM usuariorol";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " ORDER BY idusuario, idrol ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                while ($row = $base->Registro()) {
                    $obj = new Usuariorol();
                    $obj->cargar($row['idusuario'], $row['idrol']);
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

    // Modificar:
    // -> Esta funcion modifica los datos de un rol en la base de datos
    public function modificar(){
        $base = new BaseDatos();
        $resp = false;
        $consulta = "UPDATE usuariorol SET idrol = " . $this->getIdrol() . " WHERE idusuario = " . $this->getIdusuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta) !== false) {
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
        $base = new BaseDatos();
        $resp = false;
        $consulta = "DELETE FROM usuariorol WHERE idusuario = " . $this->getIdusuario() . " AND idrol = " . $this->getIdrol();
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
    public function __toString(){
        return "Usuario ID: " . $this->getIdusuario() . " - Rol ID: " . $this->getIdrol();
    }
}
?>