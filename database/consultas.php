<?php
require_once 'conexion.php';
class Consultas
{

    private $conexion;

    public function __construct()
    {
        $database = new Conexion();
        $conexion = $database->conectar();
        $this->conexion = $conexion;
    }

    public function obtenerNoticiasTop()
    {
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria ORDER BY fecha_publicacion DESC LIMIT 6");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNoticiaPorSlug($slug)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria  WHERE slug = :slug");
        $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerNoticiasPorCategoria($categoria_id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria  WHERE categoria_id = :categoria_id ORDER BY fecha_publicacion DESC");
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCategorias()
    {
        $stmt = $this->conexion->prepare("SELECT * FROM categorias");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNoticiasPorFechas($fecha_inicio, $fecha_fin)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria  WHERE fecha_publicacion BETWEEN :fecha_inicio AND :fecha_fin ORDER BY fecha_publicacion DESC");
        $stmt->bindParam(':fecha_inicio', $fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $fecha_fin, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerautores()
    {
        $stmt = $this->conexion->prepare("SELECT * FROM autores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNoticiasPorAutor($id)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria  WHERE autor_id = :id ORDER BY fecha_publicacion DESC");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerNoticiaPorNombre($titulo)
    {
        $com="%";
        $titulo = $com . $titulo . $com;
        $stmt = $this->conexion->prepare("SELECT * FROM noticias n join autores a on n.autor_id = a.id_autor join categorias c on n.categoria_id = c.id_categoria  WHERE titulo like :titulo");
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}