<?php
if (!isset($pageTitle)) {
    $pageTitle = 'TravelBooking';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <meta name="description" content="TravelBooking - Plataforma de reservas de vuelos y hoteles con diseño moderno y profesional.">
    <link rel="stylesheet" href="/TravelBooking/assets/css/style.css">
</head>
<body>