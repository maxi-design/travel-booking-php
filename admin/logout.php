<?php

require __DIR__ . '/../app/config/session.php';

unset($_SESSION['admin_id'], $_SESSION['admin_nombre']);

header('Location: /TravelBooking/admin/login.php');
exit;