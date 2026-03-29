<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../helpers/admin-auth.php';
require_once __DIR__ . '/../../helpers/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido');
}

$id = (int) ($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$ciudad = trim($_POST['ciudad'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');
$precioNoche = (float) ($_POST['precio_noche'] ?? 0);
$habitacionesDisponibles = (int) ($_POST['habitaciones_disponibles'] ?? 0);

if ($id <= 0) {
    die('ID inválido');
}

$stmt = $pdo->prepare("
    UPDATE hoteles
    SET nombre = ?, ciudad = ?, direccion = ?, descripcion = ?,
        precio_noche = ?, habitaciones_disponibles = ?
    WHERE id = ?
");

$stmt->execute([
    $nombre,
    $ciudad,
    $direccion,
    $descripcion,
    $precioNoche,
    $habitacionesDisponibles,
    $id
]);

header('Location: /TravelBooking/admin/hoteles.php');
exit;