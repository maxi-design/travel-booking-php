<?php
$pageTitle = 'Admin | Hoteles';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

$stmt = $pdo->query("SELECT * FROM hoteles ORDER BY ciudad ASC, nombre ASC");
$hoteles = $stmt->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Listado de hoteles</h1>
            <p>Consulta y administra los hoteles registrados.</p>
        </div>

        <div style="display:flex; justify-content:center; margin-bottom: 30px;">
            <a href="/TravelBooking/admin/hotel-crear.php" class="btn btn-primary">Crear nuevo hotel</a>
        </div>

        <?php if (!empty($hoteles)): ?>
            <div class="features-grid">
                <?php foreach ($hoteles as $hotel): ?>
                    <article class="feature-card">
                        <h3><?= htmlspecialchars($hotel['nombre']) ?></h3>
                        <p><strong>Ciudad:</strong> <?= htmlspecialchars($hotel['ciudad']) ?></p>
                        <p><strong>Dirección:</strong> <?= htmlspecialchars($hotel['direccion']) ?></p>
                        <p><strong>Precio por noche:</strong> $<?= number_format($hotel['precio_noche'], 2, ',', '.') ?></p>
                        <p><strong>Habitaciones disponibles:</strong> <?= (int) $hotel['habitaciones_disponibles'] ?></p>

                        <div style="display:flex; gap:10px; margin-top:18px; flex-wrap:wrap;">
                            <a href="/TravelBooking/admin/hotel-editar.php?id=<?= $hotel['id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="/TravelBooking/app/actions/admin/hotel-eliminar.php?id=<?= $hotel['id'] ?>" class="btn btn-primary" onclick="return confirm('¿Eliminar este hotel?');">Eliminar</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="feature-card" style="max-width: 700px; margin: 0 auto; text-align: center;">
                <p>No hay hoteles registrados.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>