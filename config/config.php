<?php

define("DEBUG", 1); // development => 1 / production => 0
define("ROOT", dirname(__DIR__));
define("PUBLIC", ROOT . '/public'); // access user public directory
define("APP", ROOT . '/application'); // path for application directory
define("CORE", ROOT . 'vendor/core'); // path to core files
define("HELP", ROOT . 'vendor/core/helpers');
define("CASH", ROOT . '/temporary/cash'); // temporary files
define("LOG", ROOT . '/temporary/logs'); // path for log files directory
define("CONFIG", ROOT . '/config'); // path for config file directory
define("LAYOUT", 'default'); // default layout name
define("PATH", 'http://framework'); // website address
define("ADMIN", 'http://framework/admin'); // admin cabinet


require_once ROOT . '/autoload.php'; // connect to autoload file