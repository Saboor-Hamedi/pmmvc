<?php
define('DB_PORT', '3306');
define('DB_NAME', 'school');
define('DB_USER', 'admin');
define('DB_PASSWORD', 'saboor123');
define('DB_HOST', 'db');
define('APP_NAME', 'MVC');
define('APPROOT', dirname(dirname(__FILE__)));
// config.php
define('user_id', isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null);

define('DEBUG', true);
