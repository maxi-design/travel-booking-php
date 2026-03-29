<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../config/session.php';

// Validar método
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido.');
}

// Validar sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];

// Recibir datos
$vueloId = isset($_POST['vuelo_id']) ? (int) $_POST['vuelo_id'] : 0;
$cantidadPasajeros = isset($_POST['cantidad_pasajeros']) ? (int) $_POST['cantidad_pasajeros'] : 0;

if ($vueloId <= 0 || $cantidadPasajeros <= 0) {
    die('Datos de reserva inválidos.');
}

try {
    $stmt = $pdo->prepare("SELECT * FROM vuelos WHERE id = ?");
    $stmt->execute([$vueloId]);
    $vuelo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$vuelo) {
        die('El vuelo no existe.');
    }

    if ((int) $vuelo['asientos_disponibles'] < $cantidadPasajeros) {
        die('No hay suficientes asientos disponibles.');
    }

    $fechaActual = date('Y-m-d');
    if ($vuelo['fecha_salida'] < $fechaActual) {
        die('No se puede reservar un vuelo con fecha pasada.');
    }

    $precioUnitario = (float) $vuelo['precio'];
    $precioTotal = $precioUnitario * $cantidadPasajeros;

    $pdo->beginTransaction();

    $insertReserva = $pdo->prepare("
        INSERT INTO reservas_vuelos (
            usuario_id,
            vuelo_id,
            cantidad_pasajeros,
            precio_unitario,
            precio_total,
            estado
        ) VALUES (?, ?, ?, ?, ?, 'pendiente')
    ");

    $insertReserva->execute([
        $usuarioId,
        $vueloId,
        $cantidadPasajeros,
        $precioUnitario,
        $precioTotal
    ]);

    $updateVuelo = $pdo->prepare("
        UPDATE vuelos
        SET asientos_disponibles = asientos_disponibles - ?
        WHERE id = ?
    ");

    $updateVuelo->execute([
        $cantidadPasajeros,
        $vueloId
    ]);

    $pdo->commit();

    header('Location: /TravelBooking/reserva-exitosa.php?tipo=vuelo');
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    die('Error al procesar la reserva: ' . $e->getMessage());
}