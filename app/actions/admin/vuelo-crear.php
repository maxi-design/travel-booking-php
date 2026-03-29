<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../helpers/admin-auth.php';
require_once __DIR__ . '/../../helpers/flash.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido');
}

$codigoVuelo = trim($_POST['codigo_vuelo'] ?? '');
$aerolinea = trim($_POST['aerolinea'] ?? '');
$origen = trim($_POST['origen'] ?? '');
$destino = trim($_POST['destino'] ?? '');
$fechaSalida = $_POST['fecha_salida'] ?? '';
$horaSalida = $_POST['hora_salida'] ?? '';
$horaLlegada = $_POST['hora_llegada'] ?? '';
$precio = (float) ($_POST['precio'] ?? 0);
$asientosDisponibles = (int) ($_POST['asientos_disponibles'] ?? 0);

if (
    $codigoVuelo === '' || $aerolinea === '' || $origen === '' || $destino === '' ||
    $fechaSalida === '' || $horaSalida === '' || $horaLlegada === ''
) {
    die('Todos los campos son obligatorios');
}

$stmt = $pdo->prepare("
    INSERT INTO vuelos (
        codigo_vuelo, aerolinea, origen, destino,
        fecha_salida, hora_salida, hora_llegada,
        precio, asientos_disponibles
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $codigoVuelo,
    $aerolinea,
    $origen,
    $destino,
    $fechaSalida,
    $horaSalida,
    $horaLlegada,
    $precio,
    $asientosDisponibles
]);

setFlash('success', 'Vuelo creado correctamente');
header('Location: /TravelBooking/admin/vuelos.php');
exit;