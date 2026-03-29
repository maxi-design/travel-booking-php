<?php
$pageTitle = 'Detalle de vuelo';

require __DIR__ . '/app/config/database.php';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

// Validar ID
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("Vuelo no válido");
}

// Buscar vuelo
$stmt = $pdo->prepare("SELECT * FROM vuelos WHERE id = ?");
$stmt->execute([$id]);
$vuelo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vuelo) {
    die("Vuelo no encontrado");
}
?>

<main class="section">
    <div class="container">

        <div class="section-heading">
            <span class="section-label">Detalle</span>
            <h1><?= htmlspecialchars($vuelo['aerolinea']) ?></h1>
            <p><?= $vuelo['origen'] ?> → <?= $vuelo['destino'] ?></p>
        </div>

        <div class="feature-card" style="max-width:600px; margin:auto;">

            <p><strong>Código:</strong> <?= $vuelo['codigo_vuelo'] ?></p>
            <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($vuelo['fecha_salida'])) ?></p>
            <p><strong>Salida:</strong> <?= $vuelo['hora_salida'] ?></p>
            <p><strong>Llegada:</strong> <?= $vuelo['hora_llegada'] ?></p>

            <p><strong>Precio por pasajero:</strong> 
                $<?= number_format($vuelo['precio'], 2, ',', '.') ?>
            </p>

            <p><strong>Asientos disponibles:</strong> <?= $vuelo['asientos_disponibles'] ?></p>

            <hr style="margin:20px 0;">

            <form action="reservar-vuelo.php" method="GET">

                <input type="hidden" name="id" value="<?= $vuelo['id'] ?>">

                <div class="form-group">
                    <label>Cantidad de pasajeros</label>
                    <input type="number" name="pasajeros" min="1" max="<?= min(10, (int) $vuelo['asientos_disponibles']) ?>" value="1" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full" style="margin-top:15px;">
                    Reservar vuelo
                </button>

            </form>

        </div>

    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>