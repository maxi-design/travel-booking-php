<?php
$pageTitle = 'Detalle de hotel';

require __DIR__ . '/app/config/database.php';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die('Hotel no válido');
}

$stmt = $pdo->prepare("SELECT * FROM hoteles WHERE id = ?");
$stmt->execute([$id]);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$hotel) {
    die('Hotel no encontrado');
}
?>

<main class="section">
    <div class="container">

        <div class="section-heading">
            <h1><?= htmlspecialchars($hotel['nombre']) ?></h1>
            <p><?= htmlspecialchars($hotel['ciudad']) ?></p>
        </div>

        <div class="feature-card" style="max-width:600px;margin:auto;">
            <p><strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?></p>
            <p><strong>Precio por noche:</strong> $<?= number_format($hotel['precio_noche'], 2, ',', '.') ?></p>
            <p><strong>Habitaciones disponibles:</strong> <?= $hotel['habitaciones_disponibles'] ?></p>

            <hr style="margin:20px 0;">

            <form action="reservar-hotel.php" method="GET">
                <input type="hidden" name="id" value="<?= $hotel['id'] ?>">

                <label>Noches</label>
                <input type="number" name="noches" min="1" value="1" required>

                <button class="btn btn-primary btn-full" style="margin-top:10px;">
                    Reservar hotel
                </button>
            </form>
        </div>

    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>