<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../helpers/admin-auth.php';
require_once __DIR__ . '/../../helpers/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido');
}

$nombre = trim($_POST['nombre'] ?? '');
$ciudad = trim($_POST['ciudad'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');
$precioNoche = (float) ($_POST['precio_noche'] ?? 0);
$habitacionesDisponibles = (int) ($_POST['habitaciones_disponibles'] ?? 0);

if ($nombre === '' || $ciudad === '' || $direccion === '' || $descripcion === '') {
    die('Todos los campos son obligatorios');
}

$stmt = $pdo->prepare("
    INSERT INTO hoteles (
        nombre, ciudad, direccion, descripcion,
        precio_noche, habitaciones_disponibles
    ) VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $nombre,
    $ciudad,
    $direccion,
    $descripcion,
    $precioNoche,
    $habitacionesDisponibles
]);

setFlash('success', 'Hotel creado correctamente');
header('Location: /TravelBooking/admin/hoteles.php');
exit;