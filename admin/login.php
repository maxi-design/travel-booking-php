<?php
$pageTitle = 'Login administrador';

require __DIR__ . '/../app/config/session.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: /TravelBooking/admin/dashboard.php');
    exit;
}

include __DIR__ . '/../app/includes/head.php';
include __DIR__ . '/../app/includes/header.php';
?>

<main class="section">
    <div class="container">
        <div class="section-heading">
            <span class="section-label">Administración</span>
            <h1>Ingresar al panel admin</h1>
            <p>Acceso exclusivo para administradores del sistema.</p>
        </div>

        <div class="feature-card" style="max-width: 500px; margin: 0 auto;">
            <form action="/TravelBooking/app/actions/admin/login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">
                    Ingresar como administrador
                </button>
            </form>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../app/includes/footer.php'; ?>