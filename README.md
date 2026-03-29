# ✈️ TravelBooking

Aplicación web de reservas de vuelos y hoteles desarrollada con PHP y MySQL, que simula el funcionamiento de una agencia de viajes moderna con sistema de usuarios, reservas y panel de administración.

## 🚀 Descripción

TravelBooking es un sistema completo que permite a los usuarios:

* Buscar vuelos y hoteles
* Ver detalles de cada opción
* Realizar reservas
* Gestionar sus reservas desde un panel de usuario

Además, incluye un panel de administración para gestionar el contenido del sistema.

---

## 🧩 Funcionalidades principales

### 👤 Usuarios

* Registro de usuarios
* Inicio y cierre de sesión
* Panel de usuario
* Visualización de reservas realizadas

### ✈️ Vuelos

* Listado de vuelos disponibles
* Vista de detalle
* Reserva de vuelos

### 🏨 Hoteles

* Listado de hoteles disponibles
* Vista de detalle
* Reserva de hoteles

### 🛠️ Panel de administración

* Login de administrador
* Dashboard con métricas
* CRUD de vuelos
* CRUD de hoteles
* Visualización de reservas
* Validación para evitar eliminar registros con reservas asociadas

### 🔔 Experiencia de usuario

* Mensajes de éxito y error (flash messages)
* Flujo completo de reservas
* Interfaz clara y moderna

---

## 🧱 Tecnologías utilizadas

* **Backend:** PHP (PDO)
* **Base de datos:** MySQL
* **Frontend:** HTML, CSS, JavaScript
* **Servidor local:** XAMPP

---

## 🗂️ Estructura del proyecto

```
TravelBooking/
│
├── admin/                # Panel de administración
├── app/
│   ├── actions/          # Lógica backend
│   ├── config/           # Configuración (DB, sesiones)
│   ├── helpers/          # Funciones auxiliares
│   └── includes/         # Header, footer, etc.
│
├── assets/               # CSS y JS
├── usuario/              # Panel de usuario
├── index.php             # Página principal
```

---

## ⚙️ Instalación y uso

1. Clonar el repositorio:

```
git clone https://github.com/maxi-design/travel-booking-php.git
```

2. Mover el proyecto a:

```
C:\xampp\htdocs\
```

3. Crear la base de datos en phpMyAdmin:

```
travelbooking
```

4. Importar el archivo SQL (si lo incluyes)

5. Configurar conexión en:

```
app/config/database.php
```

6. Iniciar Apache y MySQL en XAMPP

7. Abrir en el navegador:

```
http://localhost/TravelBooking
```

---

## 🔐 Acceso administrador

```
URL: http://localhost/TravelBooking/admin/login.php
Email: admin@travelbooking.com
Password: admin123
```

---

## 📸 Capturas

### Home
![Home](screenshots/home.png)

### Vuelos
![Vuelos](screenshots/vuelos.png)

### Detalle de vuelo
![Detalle vuelo](screenshots/detalle-vuelo.png)

### Hoteles
![Hoteles](screenshots/hoteles.png)

### Panel de usuario
![Usuario](screenshots/usuario-panel.png)

### Mis reservas
![Reservas](screenshots/usuario-reservas.png)

### Panel de administración
![Admin](screenshots/admin-dashboard.png)

---

## 💼 Autor

**Maximiliano Muñoz**

* Desarrollador web & diseñador digital
* Especializado en PHP, MySQL y desarrollo de interfaces web

---

## 📌 Notas

Este proyecto fue desarrollado como parte de un portfolio profesional orientado a obtener trabajos freelance y posiciones junior en desarrollo web.
