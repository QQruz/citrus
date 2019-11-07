<?php

define('DB_HOST', '');

define('DB_NAME', '');

define('DB_PORT', 3306);

define('DB_USER', '');

define('DB_PASS', '');

define('VIEWS_PATH', __DIR__ . '/src/views/');

define('PUBLIC_PATH', (empty($_SERVER['HTTPS']) ? 'http' : 'https') . '://' . $_SERVER['HTTP_HOST'] . '/');