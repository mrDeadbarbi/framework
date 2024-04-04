<?php

namespace core;

class App
{
    public static Registry $app;

    public function __construct()
    {
        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParameters();
    }
    /**
     * Функция проверяет наличие файла с праметрами
     * Так же проверяет наличие настроек в файле в виде массива параметров
     * Если файл или настройки отсутствуют скрипт преращает выполнение прлиложения
     */

    protected function getParameters(): void
    {
        if (is_file(CONFIG . '/parameters.php'))
        {
            $params = require_once CONFIG . '/parameters.php';
            if (is_array($params))
            {
                foreach ($params as $nameParameters => $valueParameters)
                {
                    self::$app->setSetting($nameParameters, $valueParameters);
                }
            } else
            {
                die('Отсутствуют настройки в файле (проверьте наличие /config/parameters.php)');
            }
        }else
        {
            die('На сервере отсутствует файл настроек (проверьте наличие /config/parameters.php)');
        }
    }
}