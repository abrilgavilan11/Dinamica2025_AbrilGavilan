<?php
include_once __DIR__ . '/conector/BaseDatos.php';

class Auto {
    private $patente;
    private $marca;
    private $modelo;
    private $dniDuenio;
    private $mensajeoperacion;

    public function __construct() {
        $this->patente = "";
        $this->marca = "";
        $this->modelo = "";
        $this->dniDuenio = "";
        $this->mensajeoperacion = "";
    }

    public function setear($patente, $marca, $modelo, $dniDuenio) {
        $this->patente = $patente;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->dniDuenio = $dniDuenio;
    }

    // Getters y Setters
    public function getPatente() { return $this->patente; }
    public function setPatente($valor) { $this->patente = $valor; }

    public function getMarca() { return $this->marca; }
    public function setMarca($valor) { $this->marca = $valor; }

    public function getModelo() { return $this->modelo; }
    public function setModelo($valor) { $this->modelo = $valor; }

    public function getDniDuenio() { return $this->dniDuenio; }
    public function setDniDuenio($valor) { $this->dniDuenio = $valor; }

    public function getMensajeOperacion() { return $this->mensajeoperacion; }
    public function setMensajeOperacion($valor) { $this->mensajeoperacion = $valor; }

    // Cargar un auto por patente
    public function cargar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "SELECT * FROM auto WHERE Patente = '{$this->patente}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > 0) {
                $row = $base->Registro();
                $this->setear($row['Patente'], $row['Marca'], $row['Modelo'], $row['DniDuenio']);
                $resp = true;
            }
        } else {
            $this->mensajeoperacion = "Auto->cargar: " . $base->getError();
        }
        return $resp;
    }

    // Insertar un nuevo auto
    public function insertar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "INSERT INTO auto (Patente, Marca, Modelo, DniDuenio) VALUES (
            '{$this->patente}', '{$this->marca}', '{$this->modelo}', '{$this->dniDuenio}')";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Auto->insertar: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Auto->insertar: " . $base->getError();
        }
        return $resp;
    }

    // Modificar un auto existente
    public function modificar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE auto SET 
            Marca = '{$this->marca}', 
            Modelo = '{$this->modelo}', 
            DniDuenio = '{$this->dniDuenio}' 
            WHERE Patente = '{$this->patente}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Auto->modificar: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Auto->modificar: " . $base->getError();
        }
        return $resp;
    }

    // Eliminar un auto por patente
    public function eliminar() {
        $resp = false;
        $base = new BaseDatos();
        $sql = "DELETE FROM auto WHERE Patente = '{$this->patente}'";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > -1) {
                $resp = true;
            } else {
                $this->mensajeoperacion = "Auto->eliminar: " . $base->getError();
            }
        } else {
            $this->mensajeoperacion = "Auto->eliminar: " . $base->getError();
        }
        return $resp;
    }

    // Listar autos (opcionalmente con filtro)
    public static function listar($parametro = "") {
        $arreglo = [];
        $base = new BaseDatos();
        $sql = "SELECT * FROM auto";
        if ($parametro != "") {
            $sql .= " WHERE $parametro";
        }
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if ($res > 0) {
                while ($row = $base->Registro()) {
                    $obj = new Auto();
                    $obj->setear($row['Patente'], $row['Marca'], $row['Modelo'], $row['DniDuenio']);
                    $arreglo[] = $obj;
                }
            }
        }
        return $arreglo;
    }
}
?>
