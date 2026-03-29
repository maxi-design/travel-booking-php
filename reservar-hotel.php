<?php
$pageTitle = 'Confirmar reserva de hotel';

require __DIR__ . '/app/config/database.php';
require __DIR__ . '/app/config/session.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

$id = $_GET['id'] ?? null;
$noches = isset($_GET['noches']) ? (int) $_GET['noches'] : 1;

if (!$id || !is_numeric($id)) {
    die('Hotel no válido.');
}

if ($noches < 1) {
    $noches = 1;
}

$stmt = $pdo->prepare("SELECT * FROM hoteles WHERE id = ?");
$stmt->execute([$id]);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$hotel) {
    die('Hotel no encontrado.');
}

if ((int) $hotel['habitaciones_disponibles'] <= 0) {
    die('No hay habitaciones disponibles.');
}

$checkin = date('Y-m-d');
$checkout = date('Y-m-d', strtotime("+$noches days"));
$cantidadHuespedes = 1;
$precioNoche = (float) $hotel['precio_noche'];
$cantidadNoches = $noches;
$precioTotal = $precioNoche * $cantidadNoches;
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Confirmación</span>
            <h1>Confirmar reserva de hotel</h1>
            <p>Revisa los datos antes de continuar con la reserva.</p>
        </div>

        <div class="feature-card" style="max-width: 720px; margin: 0 auto;">
            <h3 style="margin-bottom: 18px;"><?= htmlspecialchars($hotel['nombre']) ?></h3>

            <p><strong>Ciudad:</strong> <?= htmlspecialchars($hotel['ciudad']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?></p>
            <p><strong>Check-in:</strong> <?= date('d/m/Y', strtotime($checkin)) ?></p>
            <p><strong>Check-out:</strong> <?= date('d/m/Y', strtotime($checkout)) ?></p>
            <p><strong>Huéspedes:</strong> <?= $cantidadHuespedes ?></p>
            <p><strong>Noches:</strong> <?= $cantidadNoches ?></p>
            <p><strong>Precio por noche:</strong> $<?= number_format($precioNoche, 2, ',', '.') ?></p>
            <p><strong>Total:</strong> $<?= number_format($precioTotal, 2, ',', '.') ?></p>

            <hr style="margin: 24px 0;">

            <form action="/TravelBooking/app/actions/reservas/procesar-reserva-hotel.php" method="POST">
                <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                <input type="hidden" name="fecha_checkin" value="<?= $checkin ?>">
                <input type="hidden" name="fecha_checkout" value="<?= $checkout ?>">
                <input type="hidden" name="cantidad_huespedes" value="<?= $cantidadHuespedes ?>">
                <input type="hidden" name="precio_noche" value="<?= $precioNoche ?>">
                <input type="hidden" name="cantidad_noches" value="<?= $cantidadNoches ?>">
                <input type="hidden" name="precio_total" value="<?= $precioTotal ?>">

                <button type="submit" class="btn btn-primary btn-full">
                    Confirmar reserva
                </button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>