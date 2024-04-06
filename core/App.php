<?php

namespace core;


/**
 * Class App
 * Основной класс приложения
 */
class App
{
    /**
     * @var Registry Реестр приложения
     */
    public static Registry $app;

    /**
     * Конструктор класса App
     */
    public function __construct()
    {
        $currentHTMLQuery = trim(urldecode($_SERVER['QUERY_STRING']), '/'); // убираем '/' из текущего HTML запроса и помещаем в переменную
        new ErrorHandler();
        self::$app = Registry::getInstance();
        $this->getParameters();
        Router::routeTransmission($currentHTMLQuery);

    }

    /**
     * Получение параметров приложения из файла конфигурации
     */
    protected function getParameters(): void
    {
        /**
         * Функция проверяет наличие файла с параметрами
         * Также проверяет наличие настроек в файле в виде массива параметров
         * Если файл или настройки отсутствуют, скрипт завершает выполнение приложения
         */
        if (is_file(CONFIG . '/parameters.php'))
        {
            $params = require CONFIG . '/parameters.php';
            if (is_array($params))
            {
                foreach ($params as $nameParameters => $valueParameters)
                {
                    self::$app->setSetting($nameParameters, $valueParameters);
                }
            } else
            {
                die('Отсутствуют настройки в файле (проверьте наличие и правильность настроек в /config/parameters.php)');
            }
        } else
        {
            die('На сервере отсутствует файл настроек (проверьте наличие файла /config/parameters.php)');
        }
    }

}
