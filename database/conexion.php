<?php

class Conexion {

    private $host = "localhost";
    private $db = "entre_lineas";
    private $user = "root";
    private $password = "";

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