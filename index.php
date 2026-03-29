<?php
$pageTitle = 'TravelBooking | Inicio';
include __DIR__ . '/app/includes/head.php';
include __DIR__ . '/app/includes/header.php';
?>

<main>
    <section class="hero">
        <div class="hero-overlay"></div>

        <div class="container hero-content">
            <div class="hero-text">
                <span class="hero-badge">Tu próxima aventura comienza aquí</span>
                <h1>Reserva vuelos y hoteles con una experiencia simple, moderna y confiable</h1>
                <p>
                    Explora destinos, compara opciones y organiza tu viaje ideal desde una plataforma
                    pensada para brindar una experiencia clara, atractiva y profesional.
                </p>

                <div class="hero-actions">
                    <a href="/TravelBooking/vuelos.php" class="btn btn-primary">Buscar vuelos</a>
                    <a href="/TravelBooking/hoteles.php" class="btn btn-secondary">Buscar hoteles</a>
                </div>
            </div>

            <div class="search-card">
                <div class="search-tabs">
                    <button class="tab-btn active" data-tab="flights">Vuelos</button>
                    <button class="tab-btn" data-tab="hotels">Hoteles</button>
                </div>

                <div class="tab-content active" id="flights">
                    <form action="/TravelBooking/vuelos.php" method="GET" class="search-form">
                        <div class="form-group">
                            <label for="origen">Origen</label>
                            <input type="text" id="origen" name="origen" placeholder="Ej: Buenos Aires" required>
                        </div>

                        <div class="form-group">
                            <label for="destino">Destino</label>
                            <input type="text" id="destino" name="destino" placeholder="Ej: Madrid" required>
                        </div>

                        <div class="form-group">
                            <label for="fecha_salida">Fecha de salida</label>
                            <input type="date" id="fecha_salida" name="fecha_salida" required>
                        </div>

                        <div class="form-group">
                            <label for="pasajeros">Pasajeros</label>
                            <input type="number" id="pasajeros" name="pasajeros" min="1" max="10" value="1" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">Buscar vuelos</button>
                    </form>
                </div>

                <div class="tab-content" id="hotels">
                    <form action="/TravelBooking/hoteles.php" method="GET" class="search-form">
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" placeholder="Ej: Río de Janeiro" required>
                        </div>

                        <div class="form-group">
                            <label for="checkin">Check-in</label>
                            <input type="date" id="checkin" name="checkin" required>
                        </div>

                        <div class="form-group">
                            <label for="checkout">Check-out</label>
                            <input type="date" id="checkout" name="checkout" required>
                        </div>

                        <div class="form-group">
                            <label for="huespedes">Huéspedes</label>
                            <input type="number" id="huespedes" name="huespedes" min="1" max="10" value="2" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-full">Buscar hoteles</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="features section">
        <div class="container">
            <div class="section-heading">
                <span class="section-label">Por qué elegir TravelBooking</span>
                <h2>Una experiencia de reserva pensada para inspirar confianza</h2>
                <p>Diseño moderno, navegación clara y una estructura lista para gestionar vuelos y hoteles de forma práctica.</p>
            </div>

            <div class="features-grid">
                <article class="feature-card">
                    <div class="feature-icon">✈</div>
                    <h3>Vuelos disponibles</h3>
                    <p>Consulta opciones de viaje con información clara sobre horarios, rutas, aerolínea y precio.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">🏨</div>
                    <h3>Hoteles destacados</h3>
                    <p>Explora alojamientos con detalle visual, precio por noche y disponibilidad actualizada.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Reservas seguras</h3>
                    <p>Flujo simple para usuarios registrados, con panel personal para consultar sus reservas.</p>
                </article>

                <article class="feature-card">
                    <div class="feature-icon">📋</div>
                    <h3>Gestión profesional</h3>
                    <p>Panel administrativo preparado para gestionar vuelos, hoteles, usuarios y reservas.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="destinations section section-light">
        <div class="container">
            <div class="section-heading">
                <span class="section-label">Destinos recomendados</span>
                <h2>Inspírate para tu próximo viaje</h2>
            </div>

            <div class="destinations-grid">
                <article class="destination-card">
                    <div class="destination-image destination-image-1"></div>
                    <div class="destination-info">
                        <h3>París</h3>
                        <p>Escapadas urbanas con estilo, cultura y gastronomía.</p>
                    </div>
                </article>

                <article class="destination-card">
                    <div class="destination-image destination-image-2"></div>
                    <div class="destination-info">
                        <h3>Río de Janeiro</h3>
                        <p>Playas, energía y experiencias inolvidables frente al mar.</p>
                    </div>
                </article>

                <article class="destination-card">
                    <div class="destination-image destination-image-3"></div>
                    <div class="destination-info">
                        <h3>Madrid</h3>
                        <p>Historia, arquitectura y conexiones ideales para tu próximo itinerario.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="cta section">
        <div class="container cta-box">
            <div>
                <span class="section-label">Empieza hoy</span>
                <h2>Planifica tu próximo destino con una plataforma clara y atractiva</h2>
                <p>Explora vuelos y hoteles desde una interfaz diseñada para una experiencia moderna y profesional.</p>
            </div>

            <div class="cta-actions">
                <a href="/TravelBooking/registro.php" class="btn btn-primary">Crear cuenta</a>
                <a href="/TravelBooking/login.php" class="btn btn-secondary">Ingresar</a>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . '/app/includes/footer.php'; ?>