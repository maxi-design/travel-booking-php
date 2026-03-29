<?php
$pageTitle = 'Admin | Editar vuelo';

require __DIR__ . '/../app/config/database.php';
require __DIR__ . '/../app/helpers/admin-auth.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die('Vuelo no válido');
}

$stmt = $pdo->prepare("SELECT * FROM vuelos WHERE id = ?");
$stmt->execute([$id]);
$vuelo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vuelo) {
    die('Vuelo no encontrado');
}

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Editar vuelo</h1>
        </div>

        <div class="feature-card" style="max-width: 700px; margin: 0 auto;">
            <form action="/TravelBooking/app/actions/admin/vuelo-editar.php" method="POST">
                <input type="hidden" name="id" value="<?= $vuelo['id'] ?>">

                <div class="form-group">
                    <label>Código de vuelo</label>
                    <input type="text" name="codigo_vuelo" value="<?= htmlspecialchars($vuelo['codigo_vuelo']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Aerolínea</label>
                    <input type="text" name="aerolinea" value="<?= htmlspecialchars($vuelo['aerolinea']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Origen</label>
                    <input type="text" name="origen" value="<?= htmlspecialchars($vuelo['origen']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Destino</label>
                    <input type="text" name="destino" value="<?= htmlspecialchars($vuelo['destino']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Fecha de salida</label>
                    <input type="date" name="fecha_salida" value="<?= $vuelo['fecha_salida'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Hora de salida</label>
                    <input type="time" name="hora_salida" value="<?= $vuelo['hora_salida'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Hora de llegada</label>
                    <input type="time" name="hora_llegada" value="<?= $vuelo['hora_llegada'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01" min="0" value="<?= $vuelo['precio'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Asientos disponibles</label>
                    <input type="number" name="asientos_disponibles" min="0" value="<?= $vuelo['asientos_disponibles'] ?>" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Actualizar vuelo</button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>