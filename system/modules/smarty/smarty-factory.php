<?php
require_once('Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir(APP_PATH . '/views/');
if (!is_writable(__DIR__ . '/templates_c/')) {
    throw new RuntimeException("templates_c is not writeable");
} else {
    $smarty->setCompileDir(__DIR__ . '/templates_c/');
}
$smarty->setCacheDir(__DIR__ . '/cache/');
$smarty->setConfigDir(__DIR__ . '/config/');

$smarty->muteExpectedErrors();

return $smarty;
