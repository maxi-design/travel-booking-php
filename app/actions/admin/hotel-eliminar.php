<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../helpers/admin-auth.php';
require_once __DIR__ . '/../../helpers/flash.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    setFlash('error', 'ID inválido');
    header('Location: /TravelBooking/admin/hoteles.php');
    exit;
}

// 🔹 Verificar si tiene reservas
$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM reservas_hoteles WHERE hotel_id = ?");
$stmtCheck->execute([$id]);
$totalReservas = $stmtCheck->fetchColumn();

if ($totalReservas > 0) {
    setFlash('error', 'No puedes eliminar un hotel con reservas asociadas');
    header('Location: /TravelBooking/admin/hoteles.php');
    exit;
}

// 🔹 Eliminar hotel
$stmt = $pdo->prepare("DELETE FROM hoteles WHERE id = ?");
$stmt->execute([$id]);

setFlash('success', 'Hotel eliminado correctamente');
header('Location: /TravelBooking/admin/hoteles.php');
exit;