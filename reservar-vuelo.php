<?php
$pageTitle = 'Confirmar reserva de vuelo';

require __DIR__ . '/app/config/database.php';
require __DIR__ . '/app/config/session.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: /TravelBooking/login.php');
    exit;
}

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

$id = $_GET['id'] ?? null;
$pasajeros = isset($_GET['pasajeros']) ? (int) $_GET['pasajeros'] : 1;

if (!$id || !is_numeric($id)) {
    die('Vuelo no válido.');
}

if ($pasajeros < 1) {
    $pasajeros = 1;
}

$stmt = $pdo->prepare("SELECT * FROM vuelos WHERE id = ?");
$stmt->execute([$id]);
$vuelo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vuelo) {
    die('Vuelo no encontrado.');
}

if ($pasajeros > (int) $vuelo['asientos_disponibles']) {
    $pasajeros = (int) $vuelo['asientos_disponibles'];
}

$total = $vuelo['precio'] * $pasajeros;
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Confirmación</span>
            <h1>Confirmar reserva de vuelo</h1>
            <p>Revisa los datos antes de continuar con la reserva.</p>
        </div>

        <div class="feature-card" style="max-width: 720px; margin: 0 auto;">
            <h3 style="margin-bottom: 18px;">
                <?= htmlspecialchars($vuelo['aerolinea']) ?>
            </h3>

            <p><strong>Código:</strong> <?= htmlspecialchars($vuelo['codigo_vuelo']) ?></p>
            <p><strong>Ruta:</strong> <?= htmlspecialchars($vuelo['origen']) ?> → <?= htmlspecialchars($vuelo['destino']) ?></p>
            <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($vuelo['fecha_salida'])) ?></p>
            <p><strong>Salida:</strong> <?= htmlspecialchars($vuelo['hora_salida']) ?></p>
            <p><strong>Llegada:</strong> <?= htmlspecialchars($vuelo['hora_llegada']) ?></p>
            <p><strong>Precio por pasajero:</strong> $<?= number_format($vuelo['precio'], 2, ',', '.') ?></p>
            <p><strong>Pasajeros:</strong> <?= $pasajeros ?></p>
            <p><strong>Total:</strong> $<?= number_format($total, 2, ',', '.') ?></p>

            <hr style="margin: 24px 0;">

            <?php if ((int) $vuelo['asientos_disponibles'] <= 0): ?>
                <p style="color: #b91c1c; font-weight: 700;">Este vuelo ya no tiene asientos disponibles.</p>
                <a href="/TravelBooking/vuelos.php" class="btn btn-primary" style="margin-top: 16px;">Volver a vuelos</a>
            <?php else: ?>
                <form action="/TravelBooking/app/actions/reservas/procesar-reserva-vuelo.php" method="POST">
                    <input type="hidden" name="vuelo_id" value="<?= $vuelo['id'] ?>">
                    <input type="hidden" name="cantidad_pasajeros" value="<?= $pasajeros ?>">

                    <button type="submit" class="btn btn-primary btn-full">
                        Confirmar reserva
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>