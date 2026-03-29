<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../config/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido.');
}

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];

$hotelId = isset($_POST['hotel_id']) ? (int) $_POST['hotel_id'] : 0;
$fechaCheckin = $_POST['fecha_checkin'] ?? '';
$fechaCheckout = $_POST['fecha_checkout'] ?? '';
$cantidadHuespedes = isset($_POST['cantidad_huespedes']) ? (int) $_POST['cantidad_huespedes'] : 1;
$precioNoche = isset($_POST['precio_noche']) ? (float) $_POST['precio_noche'] : 0;
$cantidadNoches = isset($_POST['cantidad_noches']) ? (int) $_POST['cantidad_noches'] : 0;
$precioTotal = isset($_POST['precio_total']) ? (float) $_POST['precio_total'] : 0;

if (
    $hotelId <= 0 ||
    $fechaCheckin === '' ||
    $fechaCheckout === '' ||
    $cantidadHuespedes <= 0 ||
    $precioNoche <= 0 ||
    $cantidadNoches <= 0 ||
    $precioTotal <= 0
) {
    die('Datos de reserva inválidos.');
}

try {
    $stmt = $pdo->prepare("SELECT * FROM hoteles WHERE id = ?");
    $stmt->execute([$hotelId]);
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$hotel) {
        die('El hotel no existe.');
    }

    if ((int) $hotel['habitaciones_disponibles'] <= 0) {
        die('No hay habitaciones disponibles.');
    }

    $pdo->beginTransaction();

    $insertReserva = $pdo->prepare("
        INSERT INTO reservas_hoteles (
            usuario_id,
            hotel_id,
            fecha_checkin,
            fecha_checkout,
            cantidad_huespedes,
            precio_noche,
            cantidad_noches,
            precio_total,
            estado
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')
    ");

    $insertReserva->execute([
        $usuarioId,
        $hotelId,
        $fechaCheckin,
        $fechaCheckout,
        $cantidadHuespedes,
        $precioNoche,
        $cantidadNoches,
        $precioTotal
    ]);

    $updateHotel = $pdo->prepare("
        UPDATE hoteles
        SET habitaciones_disponibles = habitaciones_disponibles - 1
        WHERE id = ?
    ");

    $updateHotel->execute([$hotelId]);

    $pdo->commit();

    header('Location: /TravelBooking/reserva-exitosa.php?tipo=hotel');
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    die('Error al procesar la reserva del hotel: ' . $e->getMessage());
}