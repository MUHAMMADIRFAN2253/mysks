<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT', __DIR__);

require_once 'app/init.php';

$app = new App();
