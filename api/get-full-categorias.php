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

$id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : null;
if ($id_categoria) {
    $categorias = $consultas->obtenerNoticiasPorCategoria($id_categoria);
} else {
    $categorias = $consultas->obtenerCategorias();
}

echo json_encode($categorias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);