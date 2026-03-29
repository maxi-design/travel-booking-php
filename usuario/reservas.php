<?php
$pageTitle = 'Mis reservas';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/config/session.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];

$stmtVuelos = $pdo->prepare("
    SELECT 
        rv.id,
        rv.cantidad_pasajeros,
        rv.precio_unitario,
        rv.precio_total,
        rv.estado,
        rv.fecha_reserva,
        v.codigo_vuelo,
        v.aerolinea,
        v.origen,
        v.destino,
        v.fecha_salida,
        v.hora_salida,
        v.hora_llegada
    FROM reservas_vuelos rv
    INNER JOIN vuelos v ON rv.vuelo_id = v.id
    WHERE rv.usuario_id = ?
    ORDER BY rv.fecha_reserva DESC
");
$stmtVuelos->execute([$usuarioId]);
$reservasVuelos = $stmtVuelos->fetchAll(PDO::FETCH_ASSOC);

$stmtHoteles = $pdo->prepare("
    SELECT
        rh.id,
        rh.fecha_checkin,
        rh.fecha_checkout,
        rh.cantidad_huespedes,
        rh.precio_noche,
        rh.cantidad_noches,
        rh.precio_total,
        rh.estado,
        rh.fecha_reserva,
        h.nombre,
        h.ciudad,
        h.direccion
    FROM reservas_hoteles rh
    INNER JOIN hoteles h ON rh.hotel_id = h.id
    WHERE rh.usuario_id = ?
    ORDER BY rh.fecha_reserva DESC
");
$stmtHoteles->execute([$usuarioId]);
$reservasHoteles = $stmtHoteles->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Panel de usuario</span>
            <h1>Mis reservas</h1>
            <p>Aquí puedes consultar las reservas de vuelos y hoteles asociadas a tu cuenta.</p>
        </div>

        <div style="margin-bottom: 50px;">
            <h2 style="margin-bottom: 20px;">Reservas de vuelos</h2>

            <?php if (!empty($reservasVuelos)): ?>
                <div class="features-grid">
                    <?php foreach ($reservasVuelos as $reserva): ?>
                        <article class="feature-card">
                            <h3><?= htmlspecialchars($reserva['aerolinea']) ?></h3>
                            <p><strong>Código:</strong> <?= htmlspecialchars($reserva['codigo_vuelo']) ?></p>
                            <p><strong>Ruta:</strong> <?= htmlspecialchars($reserva['origen']) ?> → <?= htmlspecialchars($reserva['destino']) ?></p>
                            <p><strong>Fecha del vuelo:</strong> <?= date('d/m/Y', strtotime($reserva['fecha_salida'])) ?></p>
                            <p><strong>Salida:</strong> <?= htmlspecialchars($reserva['hora_salida']) ?></p>
                            <p><strong>Llegada:</strong> <?= htmlspecialchars($reserva['hora_llegada']) ?></p>
                            <p><strong>Pasajeros:</strong> <?= (int) $reserva['cantidad_pasajeros'] ?></p>
                            <p><strong>Precio unitario:</strong> $<?= number_format($reserva['precio_unitario'], 2, ',', '.') ?></p>
                            <p><strong>Total:</strong> $<?= number_format($reserva['precio_total'], 2, ',', '.') ?></p>
                            <p><strong>Estado:</strong> <?= htmlspecialchars(ucfirst($reserva['estado'])) ?></p>
                            <p><strong>Fecha de reserva:</strong> <?= date('d/m/Y H:i', strtotime($reserva['fecha_reserva'])) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="feature-card" style="max-width: 720px;">
                    <p>No tienes reservas de vuelos todavía.</p>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <h2 style="margin-bottom: 20px;">Reservas de hoteles</h2>

            <?php if (!empty($reservasHoteles)): ?>
                <div class="features-grid">
                    <?php foreach ($reservasHoteles as $reserva): ?>
                        <article class="feature-card">
                            <h3><?= htmlspecialchars($reserva['nombre']) ?></h3>
                            <p><strong>Ciudad:</strong> <?= htmlspecialchars($reserva['ciudad']) ?></p>
                            <p><strong>Dirección:</strong> <?= htmlspecialchars($reserva['direccion']) ?></p>
                            <p><strong>Check-in:</strong> <?= date('d/m/Y', strtotime($reserva['fecha_checkin'])) ?></p>
                            <p><strong>Check-out:</strong> <?= date('d/m/Y', strtotime($reserva['fecha_checkout'])) ?></p>
                            <p><strong>Huéspedes:</strong> <?= (int) $reserva['cantidad_huespedes'] ?></p>
                            <p><strong>Noches:</strong> <?= (int) $reserva['cantidad_noches'] ?></p>
                            <p><strong>Precio por noche:</strong> $<?= number_format($reserva['precio_noche'], 2, ',', '.') ?></p>
                            <p><strong>Total:</strong> $<?= number_format($reserva['precio_total'], 2, ',', '.') ?></p>
                            <p><strong>Estado:</strong> <?= htmlspecialchars(ucfirst($reserva['estado'])) ?></p>
                            <p><strong>Fecha de reserva:</strong> <?= date('d/m/Y H:i', strtotime($reserva['fecha_reserva'])) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="feature-card" style="max-width: 720px;">
                    <p>No tienes reservas de hoteles todavía.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>