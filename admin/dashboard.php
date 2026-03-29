<?php
$pageTitle = 'Dashboard admin';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

$stmtUsuarios = $pdo->query("SELECT COUNT(*) FROM usuarios");
$totalUsuarios = (int) $stmtUsuarios->fetchColumn();

$stmtVuelos = $pdo->query("SELECT COUNT(*) FROM vuelos");
$totalVuelos = (int) $stmtVuelos->fetchColumn();

$stmtHoteles = $pdo->query("SELECT COUNT(*) FROM hoteles");
$totalHoteles = (int) $stmtHoteles->fetchColumn();

$stmtReservasVuelos = $pdo->query("SELECT COUNT(*) FROM reservas_vuelos");
$totalReservasVuelos = (int) $stmtReservasVuelos->fetchColumn();

$stmtReservasHoteles = $pdo->query("SELECT COUNT(*) FROM reservas_hoteles");
$totalReservasHoteles = (int) $stmtReservasHoteles->fetchColumn();

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Panel de administración</h1>
            <p>Bienvenido, <?= htmlspecialchars($_SESSION['admin_nombre']) ?>.</p>
        </div>

        <div class="features-grid">
            <article class="feature-card">
                <h3>Usuarios</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;"><?= $totalUsuarios ?></p>
            </article>

            <article class="feature-card">
                <h3>Vuelos</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;"><?= $totalVuelos ?></p>
                <a href="/TravelBooking/admin/vuelos.php" class="btn btn-primary">Ver vuelos</a>
            </article>

            <article class="feature-card">
                <h3>Hoteles</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;"><?= $totalHoteles ?></p>
                <a href="/TravelBooking/admin/hoteles.php" class="btn btn-primary">Ver hoteles</a>
            </article>

            <article class="feature-card">
                <h3>Reservas de vuelos</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;"><?= $totalReservasVuelos ?></p>
            </article>

            <article class="feature-card">
                <h3>Reservas de hoteles</h3>
                <p style="font-size: 2rem; font-weight: 700; margin: 12px 0;"><?= $totalReservasHoteles ?></p>
                <a href="/TravelBooking/admin/reservas.php" class="btn btn-primary">Ver reservas</a>
            </article>

            <article class="feature-card">
                <h3>Sesión</h3>
                <p>Acceso activo como administrador del sistema.</p>
                <a href="/TravelBooking/admin/logout.php" class="btn btn-primary" style="margin-top: 16px;">Cerrar sesión</a>
            </article>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>