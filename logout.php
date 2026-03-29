<?php

require __DIR__ . '/app/config/session.php';

session_destroy();

header('Location: /TravelBooking/index.php');
exit;