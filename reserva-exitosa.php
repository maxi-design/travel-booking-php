<?php
$pageTitle = 'Reserva exitosa';

$tipo = $_GET['tipo'] ?? 'vuelo';

if ($tipo === 'hotel') {
    $textoBoton = 'Volver a hoteles';
    $link = '/TravelBooking/hoteles.php';
} else {
    $textoBoton = 'Volver a vuelos';
    $link = '/TravelBooking/vuelos.php';
}

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Reserva confirmada</span>
            <h1>Tu reserva fue registrada correctamente</h1>
            <p>La reserva quedó guardada con estado pendiente y ya forma parte del sistema.</p>
        </div>

        <div class="feature-card" style="max-width: 700px; margin: 0 auto; text-align: center;">
            <p style="margin-bottom: 24px;">
                Excelente, ya tienes funcionando una reserva real conectada a la base de datos.
            </p>

            <div style="display: flex; gap: 14px; justify-content: center; flex-wrap: wrap;">
                <a href="<?= $link ?>" class="btn btn-primary"><?= $textoBoton ?></a>
                <a href="/TravelBooking/index.php" class="btn btn-primary">Ir al inicio</a>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>