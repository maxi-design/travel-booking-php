<?php
$pageTitle = 'Login';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';
?>

<main class="section">
    <div class="container">

        <div class="section-heading">
            <span class="section-label">Acceso</span>
            <h1>Iniciar sesión</h1>
        </div>

        <div class="feature-card" style="max-width:500px;margin:auto;">

            <form action="/TravelBooking/app/actions/auth/login.php" method="POST">

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>

                <button class="btn btn-primary btn-full">Ingresar</button>

            </form>

        </div>

    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>