<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../config/session.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Método no permitido');
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    die('Todos los campos son obligatorios');
}

$stmt = $pdo->prepare("SELECT * FROM administradores WHERE email = ?");
$stmt->execute([$email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin || !password_verify($password, $admin['password'])) {
    die('Credenciales de administrador incorrectas');
}

$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_nombre'] = $admin['nombre'];

header('Location: /TravelBooking/admin/dashboard.php');
exit;