<?php
$pageTitle = 'Admin | Reservas';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

$stmtVuelos = $pdo->query("
    SELECT 
        rv.id,
        rv.cantidad_pasajeros,
        rv.precio_total,
        rv.estado,
        rv.fecha_reserva,
        u.nombre,
        u.apellido,
        v.codigo_vuelo,
        v.aerolinea,
        v.origen,
        v.destino
    FROM reservas_vuelos rv
    INNER JOIN usuarios u ON rv.usuario_id = u.id
    INNER JOIN vuelos v ON rv.vuelo_id = v.id
    ORDER BY rv.fecha_reserva DESC
");
$reservasVuelos = $stmtVuelos->fetchAll(PDO::FETCH_ASSOC);

$stmtHoteles = $pdo->query("
    SELECT
        rh.id,
        rh.cantidad_noches,
        rh.precio_total,
        rh.estado,
        rh.fecha_reserva,
        u.nombre,
        u.apellido,
        h.nombre AS hotel_nombre,
        h.ciudad
    FROM reservas_hoteles rh
    INNER JOIN usuarios u ON rh.usuario_id = u.id
    INNER JOIN hoteles h ON rh.hotel_id = h.id
    ORDER BY rh.fecha_reserva DESC
");
$reservasHoteles = $stmtHoteles->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Reservas del sistema</h1>
            <p>Consulta las reservas de vuelos y hoteles registradas.</p>
        </div>

        <div style="margin-bottom: 50px;">
            <h2 style="margin-bottom: 20px;">Reservas de vuelos</h2>

            <?php if (!empty($reservasVuelos)): ?>
                <div class="features-grid">
                    <?php foreach ($reservasVuelos as $reserva): ?>
                        <article class="feature-card">
                            <h3><?= htmlspecialchars($reserva['aerolinea']) ?></h3>
                            <p><strong>Usuario:</strong> <?= htmlspecialchars($reserva['nombre'] . ' ' . $reserva['apellido']) ?></p>
                            <p><strong>Código:</strong> <?= htmlspecialchars($reserva['codigo_vuelo']) ?></p>
                            <p><strong>Ruta:</strong> <?= htmlspecialchars($reserva['origen']) ?> → <?= htmlspecialchars($reserva['destino']) ?></p>
                            <p><strong>Pasajeros:</strong> <?= (int) $reserva['cantidad_pasajeros'] ?></p>
                            <p><strong>Total:</strong> $<?= number_format($reserva['precio_total'], 2, ',', '.') ?></p>
                            <p><strong>Estado:</strong> <?= htmlspecialchars(ucfirst($reserva['estado'])) ?></p>
                            <p><strong>Fecha de reserva:</strong> <?= date('d/m/Y H:i', strtotime($reserva['fecha_reserva'])) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="feature-card" style="max-width: 700px;">
                    <p>No hay reservas de vuelos registradas.</p>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <h2 style="margin-bottom: 20px;">Reservas de hoteles</h2>

            <?php if (!empty($reservasHoteles)): ?>
                <div class="features-grid">
                    <?php foreach ($reservasHoteles as $reserva): ?>
                        <article class="feature-card">
                            <h3><?= htmlspecialchars($reserva['hotel_nombre']) ?></h3>
                            <p><strong>Usuario:</strong> <?= htmlspecialchars($reserva['nombre'] . ' ' . $reserva['apellido']) ?></p>
                            <p><strong>Ciudad:</strong> <?= htmlspecialchars($reserva['ciudad']) ?></p>
                            <p><strong>Noches:</strong> <?= (int) $reserva['cantidad_noches'] ?></p>
                            <p><strong>Total:</strong> $<?= number_format($reserva['precio_total'], 2, ',', '.') ?></p>
                            <p><strong>Estado:</strong> <?= htmlspecialchars(ucfirst($reserva['estado'])) ?></p>
                            <p><strong>Fecha de reserva:</strong> <?= date('d/m/Y H:i', strtotime($reserva['fecha_reserva'])) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="feature-card" style="max-width: 700px;">
                    <p>No hay reservas de hoteles registradas.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>