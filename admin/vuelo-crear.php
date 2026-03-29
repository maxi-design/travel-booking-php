<?php
$pageTitle = 'Admin | Crear vuelo';

require __DIR__ . '/../app/helpers/admin-auth.php';
include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Crear vuelo</h1>
        </div>

        <div class="feature-card" style="max-width: 700px; margin: 0 auto;">
            <form action="/TravelBooking/app/actions/admin/vuelo-crear.php" method="POST">
                <div class="form-group">
                    <label>Código de vuelo</label>
                    <input type="text" name="codigo_vuelo" required>
                </div>

                <div class="form-group">
                    <label>Aerolínea</label>
                    <input type="text" name="aerolinea" required>
                </div>

                <div class="form-group">
                    <label>Origen</label>
                    <input type="text" name="origen" required>
                </div>

                <div class="form-group">
                    <label>Destino</label>
                    <input type="text" name="destino" required>
                </div>

                <div class="form-group">
                    <label>Fecha de salida</label>
                    <input type="date" name="fecha_salida" required>
                </div>

                <div class="form-group">
                    <label>Hora de salida</label>
                    <input type="time" name="hora_salida" required>
                </div>

                <div class="form-group">
                    <label>Hora de llegada</label>
                    <input type="time" name="hora_llegada" required>
                </div>

                <div class="form-group">
                    <label>Precio</label>
                    <input type="number" name="precio" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label>Asientos disponibles</label>
                    <input type="number" name="asientos_disponibles" min="0" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Guardar vuelo</button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>