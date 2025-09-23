<?php
include_once (__DIR__ . '/conector/BaseDatos.php');

class Persona {
    private $nroDni;
    private $apellido;
    private $nombre;
    private $fechaNac;
    private $telefono;
    private $domicilio;
    private $mensajeoperacion;

    public function __construct() {
        $this->nroDni = "";
        $this->apellido = "";
        $this->nombre = "";
        $this->fechaNac = "";
        $this->telefono = "";
        $this->domicilio = "";
        $this->mensajeoperacion = "";
    }

    public function setear($dni, $ape, $nom, $fecha, $tel, $dom) {
        $this->nroDni = $dni;
        $this->apellido = $ape;
        $this->nombre = $nom;
        $this->fechaNac = $fecha;
        $this->telefono = $tel;
        $this->domicilio = $dom;
    }

    // Getters y Setters
    public function getNroDni() { return $this->nroDni; }
    public function setNroDni($valor) { $this->nroDni = $valor; }

    public function getApellido() { return $this->apellido; }
    public function setApellido($valor) { $this->apellido = $valor; }

    public function getNombre() { return $this->nombre; }
    public function setNombre($valor) { $this->nombre = $valor; }

    public function getFechaNac() { return $this->fechaNac; }
    public function setFechaNac($valor) { $this->fechaNac = $valor; }

    public function getTelefono() { return $this->telefono; }
    public function setTelefono($valor) { $this->telefono = $valor; }

    public function getDomicilio() { return $this->domicilio; }
    public function setDomicilio($valor) { $this->domicilio = $valor; }

    public function getMensajeOperacion() { return $this->mensajeoperacion; }
    public function setMensajeOperacion($valor) { $this->mensajeoperacion = $valor; }

    // Cargar una persona por DNI
    public function cargar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM persona WHERE NroDni = '{$this->nroDni}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > 0) {
                $row = $base->Registro();
                $this->setear($row['NroDni'], $row['Apellido'], $row['Nombre'], $row['fechaNac'], $row['Telefono'], $row['Domicilio']);
                $resp = true;
            }
        } else {
            $this->mensajeoperacion = "Persona->cargar: " . $base->getError();
        }
        return $resp;
    }

    // Insertar una nueva persona
    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO persona (NroDni, Apellido, Nombre, fechaNac, Telefono, Domicilio) VALUES (
            '{$this->nroDni}', '{$this->apellido}', '{$this->nombre}', '{$this->fechaNac}', '{$this->telefono}', '{$this->domicilio}')";
        
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Persona->insertar: SQL: " . $base->getSQL() . " | Error: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Persona->insertar: Error de conexión: " . $base->getError();
        }

        return $resp;
    }

    // Modificar una persona existente
    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE persona SET 
            Apellido = '{$this->apellido}', 
            Nombre = '{$this->nombre}', 
            fechaNac = '{$this->fechaNac}', 
            Telefono = '{$this->telefono}', 
            Domicilio = '{$this->domicilio}' 
            WHERE NroDni = '{$this->nroDni}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Persona->modificar: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Persona->modificar: " . $base->getError();
        }
        return $resp;
    }

    // Eliminar una persona por DNI
    public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM persona WHERE NroDni = '{$this->nroDni}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Persona->eliminar: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Persona->eliminar: " . $base->getError();
        }
        return $resp;
    }

    // Listar personas (opcionalmente con filtro)
    public static function listar($parametro = "") {
        $arreglo = [];
        $base = new BaseDatos();
        $sql = "SELECT * FROM persona";
        if ($parametro != "") {
            $sql .= " WHERE $parametro";
        }
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Persona();
                    $obj->setear($row['NroDni'], $row['Apellido'], $row['Nombre'], $row['fechaNac'], $row['Telefono'], $row['Domicilio']);
                    $arreglo[] = $obj;
                }
            }
        }
        return $arreglo;
    }
}
?>
