<?php
/**
 * Определение констант для настройки приложения
 */
define ("DEBUG", 1); // development => 1 / production => 0
define ("ROOT", dirname(__DIR__));
define ("HTTP", ROOT . '/public'); // access user public directory // доступ к папке с публичными файлами для пользователей
define ("APP", ROOT . '/application'); // path for application directory // путь к папке с файлами приложения
define ("CORE", ROOT . '/core'); // path to core files // путь к файлам ядра приложения
define ("HELP", ROOT . '/core/helpers'); // вспомогательные функции
define ("CASH", ROOT . '/temporary/cash'); // temporary files  // временные файлы
define ("LOG", ROOT . '/temporary/logs'); // path for log files directory // путь к файлам журналов
define ("CONFIG", ROOT . '/config'); // path for config file directory // путь к файлам конфигурации
define ("LAYOUT", 'default'); // default layout name // название используемого макета(шаблона) по умолчанию
define ("PATH", 'http://framework'); // website address // адрес веб-сайта
define ("ADMIN", 'http://framework/admin'); // admin cabinet // адрес административной панели


require_once ROOT . '/vendor/autoload.php'; // connect to autoload file // подключение файла автозагрузки