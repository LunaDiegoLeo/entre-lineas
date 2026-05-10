<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json; charset=utf-8');
require_once '../database/consultas.php';

$consultas = new Consultas();


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {

    http_response_code(405);

    echo json_encode([
        'error' => 'Método no permitido'
    ]);

    exit;

}

$slug = $_GET['slug'] ?? null;

if ($slug) {

    $noticias = $consultas->obtenerNoticiaPorSlug($slug);

} else if(isset($_GET['titulo'])) {

    $titulo = $_GET['titulo'];
    $noticias = $consultas->obtenerNoticiaPorNombre($titulo);
}
 else {

    $noticias = $consultas->obtenerNoticiasTop();

}

echo json_encode($noticias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);