<?php
$pageTitle = 'Admin | Crear hotel';

require __DIR__ . '/../app/helpers/admin-auth.php';
include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Crear hotel</h1>
            <p>Completa los datos para registrar un nuevo hotel.</p>
        </div>

        <div class="feature-card" style="max-width: 700px; margin: 0 auto;">
            <form action="/TravelBooking/app/actions/admin/hotel-crear.php" method="POST">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Ciudad</label>
                    <input type="text" name="ciudad" required>
                </div>

                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label>Precio por noche</label>
                    <input type="number" name="precio_noche" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label>Habitaciones disponibles</label>
                    <input type="number" name="habitaciones_disponibles" min="0" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Guardar hotel</button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>