<?php

require __DIR__ . '/vendor/autoload.php';

// Run controller
$controller = new \Controllers\IndexController();
$vars = $controller->exportPage();

// Render view
ob_start();
extract($vars);

include __DIR__ . '/views/index.php';

$output = ob_get_clean();

echo $output;
