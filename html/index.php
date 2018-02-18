<?php
Locale::setDefault('nl_NL');

require __DIR__ . '/../vendor/autoload.php';

use \Slim\App;

$settings = require __DIR__ . '/../Src/Config/defaultSettings.php';
$app = new App($settings);

// Setup dependencies
require __DIR__ . '/../Src/dependencies.php';

// Setup routes
require __DIR__ . '/../Src/routes.php';

// Run app
$app->run();