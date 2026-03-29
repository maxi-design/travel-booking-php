<?php
$pageTitle = 'Admin | Vuelos';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

$stmt = $pdo->query("SELECT * FROM vuelos ORDER BY fecha_salida ASC, hora_salida ASC");
$vuelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Listado de vuelos</h1>
            <p>Consulta y administra los vuelos registrados.</p>
        </div>

        <div style="display:flex; justify-content:center; margin-bottom: 30px;">
            <a href="/TravelBooking/admin/vuelo-crear.php" class="btn btn-primary">Crear nuevo vuelo</a>
        </div>

        <?php if (!empty($vuelos)): ?>
            <div class="features-grid">
                <?php foreach ($vuelos as $vuelo): ?>
                    <article class="feature-card">
                        <h3><?= htmlspecialchars($vuelo['aerolinea']) ?></h3>
                        <p><strong>Código:</strong> <?= htmlspecialchars($vuelo['codigo_vuelo']) ?></p>
                        <p><strong>Ruta:</strong> <?= htmlspecialchars($vuelo['origen']) ?> → <?= htmlspecialchars($vuelo['destino']) ?></p>
                        <p><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($vuelo['fecha_salida'])) ?></p>
                        <p><strong>Salida:</strong> <?= htmlspecialchars($vuelo['hora_salida']) ?></p>
                        <p><strong>Llegada:</strong> <?= htmlspecialchars($vuelo['hora_llegada']) ?></p>
                        <p><strong>Precio:</strong> $<?= number_format($vuelo['precio'], 2, ',', '.') ?></p>
                        <p><strong>Asientos disponibles:</strong> <?= (int) $vuelo['asientos_disponibles'] ?></p>

                        <div style="display:flex; gap:10px; margin-top:18px; flex-wrap:wrap;">
                            <a href="/TravelBooking/admin/vuelo-editar.php?id=<?= $vuelo['id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="/TravelBooking/app/actions/admin/vuelo-eliminar.php?id=<?= $vuelo['id'] ?>" class="btn btn-primary" onclick="return confirm('¿Eliminar este vuelo?');">Eliminar</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="feature-card" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <p>No hay vuelos registrados.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>