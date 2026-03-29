<?php
$pageTitle = 'Admin | Editar hotel';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

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

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Editar hotel</h1>
        </div>

        <div class="feature-card" style="max-width: 700px; margin: 0 auto;">
            <form action="/TravelBooking/app/actions/admin/hotel-editar.php" method="POST">
                <input type="hidden" name="id" value="<?= $hotel['id'] ?>">

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($hotel['nombre']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad" value="<?= htmlspecialchars($hotel['ciudad']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" value="<?= htmlspecialchars($hotel['direccion']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4" required><?= htmlspecialchars($hotel['descripcion']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Precio por noche</label>
                    <input type="number" name="precio_noche" step="0.01" min="0" value="<?= $hotel['precio_noche'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Habitaciones disponibles</label>
                    <input type="number" name="habitaciones_disponibles" min="0" value="<?= $hotel['habitaciones_disponibles'] ?>" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Actualizar hotel</button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>