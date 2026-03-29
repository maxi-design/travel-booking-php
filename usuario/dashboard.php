<?php
$pageTitle = 'Panel de usuario';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/config/session.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario_id'];
$usuarioNombre = $_SESSION['usuario_nombre'] ?? 'Usuario';

// Total reservas de vuelos
$stmtVuelos = $pdo->prepare("SELECT COUNT(*) FROM reservas_vuelos WHERE usuario_id = ?");
$stmtVuelos->execute([$usuarioId]);
$totalReservasVuelos = (int) $stmtVuelos->fetchColumn();

// Total reservas de hoteles
$stmtHoteles = $pdo->prepare("SELECT COUNT(*) FROM reservas_hoteles WHERE usuario_id = ?");
$stmtHoteles->execute([$usuarioId]);
$totalReservasHoteles = (int) $stmtHoteles->fetchColumn();

// Última reserva de vuelo
$stmtUltima = $pdo->prepare("
    SELECT rv.fecha_reserva, v.aerolinea, v.origen, v.destino
    FROM reservas_vuelos rv
    INNER JOIN vuelos v ON rv.vuelo_id = v.id
    WHERE rv.usuario_id = ?
    ORDER BY rv.fecha_reserva DESC
    LIMIT 1
");
$stmtUltima->execute([$usuarioId]);
$ultimaReservaVuelo = $stmtUltima->fetch(PDO::FETCH_ASSOC);

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Área privada</span>
            <h1>Bienvenido, <?= htmlspecialchars($usuarioNombre) ?></h1>
            <p>Desde aquí puedes consultar tus reservas y continuar explorando vuelos y hoteles.</p>
        </div>

        <div class="features-grid">
            <article class="feature-card">
                <h3>Reservas de vuelos</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;">
                    <?= $totalReservasVuelos ?>
                </p>
                <a href="/TravelBooking/usuario/reservas.php" class="btn btn-primary">Ver mis reservas</a>
            </article>

            <article class="feature-card">
                <h3>Reservas de hoteles</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;">
                    <?= $totalReservasHoteles ?>
                </p>
                <a href="/TravelBooking/hoteles.php" class="btn btn-primary">Explorar hoteles</a>
            </article>

            <article class="feature-card">
                <h3>Buscar vuelos</h3>
                <p>Consulta nuevas rutas, fechas disponibles y opciones para tu próximo viaje.</p>
                <a href="/TravelBooking/vuelos.php" class="btn btn-primary" style="margin-top: 16px;">Explorar vuelos</a>
            </article>

            <article class="feature-card">
                <h3>Última actividad</h3>
                <?php if ($ultimaReservaVuelo): ?>
                    <p><strong>Aerolínea:</strong> <?= htmlspecialchars($ultimaReservaVuelo['aerolinea']) ?></p>
                    <p><strong>Ruta:</strong> <?= htmlspecialchars($ultimaReservaVuelo['origen']) ?> → <?= htmlspecialchars($ultimaReservaVuelo['destino']) ?></p>
                    <p><strong>Reserva:</strong> <?= date('d/m/Y H:i', strtotime($ultimaReservaVuelo['fecha_reserva'])) ?></p>
                <?php else: ?>
                    <p>Todavía no has realizado reservas de vuelos.</p>
                <?php endif; ?>
            </article>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>