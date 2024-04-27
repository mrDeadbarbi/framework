<?php

use core\App;
use core\Router;

if (PHP_MAJOR_VERSION < 8)
{
    $php = phpversion();
    die('Используемая версия PHP ' . $php . ', версия PHP на сервере должна быть не ниже 8.0');
}

require_once  dirname(__DIR__) . '/config/config.php';
require_once  HELP . '/functions.php';
require_once  CONFIG . '/routes.php';

new App();
//var_dump(App::$app->getAllSettings());
//debug(Router::getRoutesTable());


//new App();
//throw new Exception('Возникла ошибочка!', 0);

?>

