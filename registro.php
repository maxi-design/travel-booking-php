<?php
$pageTitle = 'Registro';

include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';
?>

<main class="section">
    <div class="container">

        <div class="section-heading">
            <span class="section-label">Registro</span>
            <h1>Crear cuenta</h1>
        </div>

        <div class="feature-card" style="max-width:500px;margin:auto;">

            <form action="/TravelBooking/app/actions/auth/registro.php" method="POST">

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" required>
                </div>

                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" name="password" required>
                </div>

                <button class="btn btn-primary btn-full">Registrarse</button>

            </form>

        </div>

    </div>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>