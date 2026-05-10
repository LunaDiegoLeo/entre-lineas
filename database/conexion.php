<?php
if (file_exists(__DIR__ . '/config_local.php')) {
    include(__DIR__ . '/config_local.php');
}
class Conexion {

    private $host = defined('DB_HOST') ? DB_HOST : getenv('DB_HOST');
    private $user = defined('DB_USER') ? DB_USER : getenv('DB_USER');
    private $password = defined('DB_PASS') ? DB_PASS : getenv('DB_PASS');
    private $db = defined('DB_NAME') ? DB_NAME : getenv('DB_NAME');

    private $conexion;

    public function conectar() {

        try {

            $this->conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->user,
                $this->password
            );

            $this->conexion->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $this->conexion;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }

    }

}