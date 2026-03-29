<?php require __DIR__ . '/../config/session.php'; ?>

<header class="site-header">
    <div class="container header-container">
        <a href="/TravelBooking/index.php" class="logo">
            <span class="logo-icon">✈</span>
            <span class="logo-text">TravelBooking</span>
        </a>

        <button class="nav-toggle" id="navToggle" aria-label="Abrir menú">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="main-nav" id="mainNav">
            <?php if (isset($_SESSION['admin_id'])): ?>
                <a href="/TravelBooking/admin/dashboard.php">Dashboard admin</a>
                <a href="/TravelBooking/admin/vuelos.php">Vuelos</a>
                <a href="/TravelBooking/admin/hoteles.php">Hoteles</a>
                <a href="/TravelBooking/admin/reservas.php">Reservas</a>
                <span class="nav-user">Admin: <?= htmlspecialchars($_SESSION['admin_nombre']) ?></span>
                <a href="/TravelBooking/admin/logout.php">Salir</a>

            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                <a href="/TravelBooking/index.php">Inicio</a>
                <a href="/TravelBooking/vuelos.php">Vuelos</a>
                <a href="/TravelBooking/hoteles.php">Hoteles</a>
                <a href="/TravelBooking/usuario/dashboard.php">Mi panel</a>
                <a href="/TravelBooking/usuario/reservas.php">Mis reservas</a>
                <span class="nav-user">Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
                <a href="/TravelBooking/logout.php">Salir</a>

            <?php else: ?>
                <a href="/TravelBooking/index.php">Inicio</a>
                <a href="/TravelBooking/vuelos.php">Vuelos</a>
                <a href="/TravelBooking/hoteles.php">Hoteles</a>
                <a href="/TravelBooking/login.php">Ingresar</a>
                <a href="/TravelBooking/registro.php" class="btn btn-nav">Crear cuenta</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<?php
require_once __DIR__ . '/../helpers/flash.php';
$flash = getFlash();
?>

<?php if ($flash): ?>

    <?php
        $bg = '#e6f7ee';
        $color = '#1b5e20';

        if ($flash['type'] === 'error') {
            $bg = '#fdecea';
            $color = '#b71c1c';
        }
    ?>

    <div style="
        max-width:900px;
        margin:20px auto;
        padding:14px 18px;
        border-radius:8px;
        background:<?= $bg ?>;
        color:<?= $color ?>;
        font-weight:500;
    ">
        <?= htmlspecialchars($flash['message']) ?>
    </div>

<?php endif; ?>