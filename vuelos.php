<?php
$pageTitle = 'TravelBooking | Vuelos';

require __DIR__ . '/app/config/database.php';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';

// Obtener filtros
$origen = $_GET['origen'] ?? '';
$destino = $_GET['destino'] ?? '';
$fecha_salida = $_GET['fecha_salida'] ?? '';
$pasajeros = $_GET['pasajeros'] ?? 1;

// Query base
$sql = "SELECT * FROM vuelos WHERE 1=1";
$params = [];

// Filtros dinámicos
if (!empty($origen)) {
    $sql .= " AND origen LIKE ?";
    $params[] = "%$origen%";
}

if (!empty($destino)) {
    $sql .= " AND destino LIKE ?";
    $params[] = "%$destino%";
}

if (!empty($fecha_salida)) {
    $sql .= " AND fecha_salida = ?";
    $params[] = $fecha_salida;
}

$sql .= " ORDER BY fecha_salida ASC";

// Ejecutar consulta
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="section">
    <div class="container">

        <div class="section-heading">
            <span class="section-label">Resultados</span>
            <h1>Vuelos disponibles</h1>
            <p>Resultados de tu búsqueda</p>
        </div>

        <?php if (!empty($vuelos)): ?>

            <div class="features-grid">

                <?php foreach ($vuelos as $vuelo): ?>
                    <div class="feature-card">

                        <h3><?= htmlspecialchars($vuelo['aerolinea']) ?></h3>

                        <p><strong>Código:</strong> <?= $vuelo['codigo_vuelo'] ?></p>
                        <p><strong>Ruta:</strong> <?= $vuelo['origen'] ?> → <?= $vuelo['destino'] ?></p>
                        <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($vuelo['fecha_salida'])) ?></p>
                        <p><strong>Salida:</strong> <?= $vuelo['hora_salida'] ?></p>
                        <p><strong>Llegada:</strong> <?= $vuelo['hora_llegada'] ?></p>

                        <p><strong>Precio:</strong> $<?= number_format($vuelo['precio'], 2, ',', '.') ?></p>
                        <p>
                            <strong>Asientos:</strong> 
                            <?= $vuelo['asientos_disponibles'] > 0 ? $vuelo['asientos_disponibles'] : 'Sin disponibilidad' ?>
                        </p>

                        <a href="vuelo-detalle.php?id=<?= $vuelo['id'] ?>" class="btn btn-primary" style="margin-top:10px;">
                            Ver detalle
                        </a>

                    </div>
                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <div class="section-heading">
                <h2>No se encontraron vuelos</h2>
                <p>Intenta con otros filtros</p>
            </div>

        <?php endif; ?>

    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>