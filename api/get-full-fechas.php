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

$fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
$fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;

if ($fecha_inicio && $fecha_fin) {
    $noticias = $consultas->obtenerNoticiasPorFechas($fecha_inicio, $fecha_fin);
} else {
    $noticias = $consultas->obtenerNoticiasTop();
}

echo json_encode($noticias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);