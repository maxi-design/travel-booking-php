<?php

require __DIR__ . '/../../config/database.php';
require __DIR__ . '/../../config/session.php';

$nombre = $_POST['nombre'] ?? '';
$apellido = $_POST['apellido'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$nombre || !$apellido || !$email || !$password) {
    die('Todos los campos son obligatorios');
}

// Verificar email existente
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    die('El email ya está registrado');
}

// Hash password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Insertar usuario
$stmt = $pdo->prepare("
    INSERT INTO usuarios (nombre, apellido, email, password)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([$nombre, $apellido, $email, $passwordHash]);

// Obtener ID
$usuarioId = $pdo->lastInsertId();

// Crear sesión
$_SESSION['usuario_id'] = $usuarioId;
$_SESSION['usuario_nombre'] = $nombre;

// Redirigir
header('Location: /TravelBooking/index.php');
exit;