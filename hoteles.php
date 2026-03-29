<?php
$pageTitle = 'Hoteles';

require __DIR__ . '/app/config/database.php';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

$stmt = $pdo->query("SELECT * FROM hoteles ORDER BY ciudad ASC");
$hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Hoteles</span>
            <h1>Hoteles disponibles</h1>
        </div>

        <div class="features-grid">
            <?php foreach ($hoteles as $hotel): ?>
                <div class="feature-card">
                    <h3><?= htmlspecialchars($hotel['nombre']) ?></h3>
                    <p><strong>Ciudad:</strong> <?= htmlspecialchars($hotel['ciudad']) ?></p>
                    <p><strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?></p>
                    <p><strong>Precio por noche:</strong> $<?= number_format($hotel['precio_noche'], 2, ',', '.') ?></p>
                    <p><strong>Habitaciones:</strong> <?= $hotel['habitaciones_disponibles'] ?></p>

                    <a href="hotel-detalle.php?id=<?= $hotel['id'] ?>" class="btn btn-primary" style="margin-top:10px;">
                        Ver detalle
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>