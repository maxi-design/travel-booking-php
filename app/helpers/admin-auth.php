<?php

require_once __DIR__ . '/../config/session.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: /TravelBooking/admin/login.php');
    exit;
}