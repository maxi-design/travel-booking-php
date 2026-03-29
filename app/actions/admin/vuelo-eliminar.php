<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../helpers/admin-auth.php';
require_once __DIR__ . '/../../helpers/flash.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    setFlash('error', 'ID inválido');
    header('Location: /TravelBooking/admin/vuelos.php');
    exit;
}

// 🔹 Verificar reservas
$stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM reservas_vuelos WHERE vuelo_id = ?");
$stmtCheck->execute([$id]);
$totalReservas = $stmtCheck->fetchColumn();

if ($totalReservas > 0) {
    setFlash('error', 'No puedes eliminar un vuelo con reservas asociadas');
    header('Location: /TravelBooking/admin/vuelos.php');
    exit;
}

// 🔹 Eliminar vuelo
$stmt = $pdo->prepare("DELETE FROM vuelos WHERE id = ?");
$stmt->execute([$id]);

setFlash('success', 'Vuelo eliminado correctamente');
header('Location: /TravelBooking/admin/vuelos.php');
exit;