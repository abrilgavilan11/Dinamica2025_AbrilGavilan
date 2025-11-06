<?php
class BaseDatos extends PDO {
    private $engine = 'mysql';
    private $host = 'localhost';
    private $database = 'login_system';
    private $user = 'root';
    private $pass = '';
    private $debug = true;
    private $error = "";
    private $sql = "";
    private $conec = false;
    private $indice = 0;
    private $resultado = [];

    public function __construct() {
        $dsn = "{$this->engine}:dbname={$this->database};host={$this->host}";
        try {
            parent::__construct($dsn, $this->user, $this->pass, [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $this->conec = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->conec = false;
        }
    }

    public function Iniciar() {
        $estado = $this->conec;
        return $estado;
    }

    public function setDebug($debug) {
        $this->debug = $debug;
    }

    public function getDebug() {
        return $this->debug;
    }

    public function getError() {
        return $this->error;
    }

    public function getSQL() {
        return $this->sql;
    }

    public function Ejecutar($sql) {
        $this->error = "";
        $this->sql = $sql;
        $sqlLower = strtolower($sql);
        $resultado = -1;

        if (str_starts_with($sqlLower, 'insert')) {
            $resultado = $this->EjecutarInsert($sql) ? 1 : -1;
        } elseif (str_starts_with($sqlLower, 'update') || str_starts_with($sqlLower, 'delete')) {
            $resultado = $this->EjecutarDeleteUpdate($sql);
        } elseif (str_starts_with($sqlLower, 'select')) {
            $resultado = $this->EjecutarSelect($sql);
        } else {
            $this->error = "Tipo de operación no reconocida.";
        }

        return $resultado;
    }

    private function EjecutarInsert($sql) {
        $resultado = false;
        try {
            $this->query($sql);
            $resultado = true;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->mostrarDebug($e);
        }
        return $resultado;
    }

    private function EjecutarDeleteUpdate($sql) {
        $cantFilas = -1;
        try {
            $resultado = $this->query($sql);
            $cantFilas = $resultado->rowCount();
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->mostrarDebug($e);
        }
        return $cantFilas;
    }

    private function EjecutarSelect($sql) {
        $cantidad = -1;
        try {
            $resultado = $this->query($sql);
            $this->resultado = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $this->indice = 0;
            $cantidad = count($this->resultado);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            $this->mostrarDebug($e);
        }
        return $cantidad;
    }

    public function Registro() {
        $filaActual = false;
        if ($this->indice >= 0 && $this->indice < count($this->resultado)) {
            $filaActual = $this->resultado[$this->indice];
            $this->indice++;
        } else {
            $this->indice = -1;
        }
        return $filaActual;
    }

    private function mostrarDebug($e) {
        if ($this->debug) {
            echo "<pre><strong>SQL:</strong> {$this->sql}\n<strong>Error:</strong> {$e->getMessage()}</pre>";
        }
    }
}
?>
