<?php
define('APP_PATH', dirname(__FILE__) . '/application');
define('SYS_PATH', dirname(__FILE__) . '/system');
define('APP_URL', 'http://localhost/m/');

if (!file_exists(APP_PATH)) {
    die('APP_PATH does not exist.');
} else if (!file_exists(SYS_PATH)) {
    die('SYS_PATH does not exist.');
} else if (!file_exists('.htaccess')) {
    die('.htaccess does not exist.');
}

require_once(SYS_PATH . '/core/module-loader.php');
$module_loader = new Framework\ModuleLoader();

$module_loader->load('application');
