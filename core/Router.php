<?php

namespace core;

use http\Params;

/**
 * Class Router
 * Маршрутизатор приложения
 */
class Router
{
    /**
     * @var array Ассоциативный массив для хранения таблицы маршрутов
     */
    protected static array $routesTable = [];

    /**
     * @var array Текущий маршрут
     */
    protected static array $route = [];

    /**
     * Добавление маршрута в таблицу маршрутов
     *
     * @param string $regularExpressionPattern Регулярное выражение для маршрута
     * @param array $route Данные маршрута
     */
    public static function addRoute($regularExpressionPattern, $route = []): void
    {
        self::$routesTable[$regularExpressionPattern] = $route;
    }

    /**
     * Получение таблицы маршрутов
     *
     * @return array Таблица маршрутов
     */
    public static function getRoutesTable(): array
    {
        return self::$routesTable;
    }

    /**
     * Получение текущего маршрута
     *
     * @return array Текущий маршрут
     */
    public static function getRoute(): array
    {
        return self::$route;
    }
    /**
     * Служебный метод отделения гет параметров от основного URL
     *
     * @param string $currentHTMLQuery Текущий URL запрос
     */

    protected static function removeQueryString($currentHTMLQuery): string
    {
        if($currentHTMLQuery)
        {
           $params = explode('&', $currentHTMLQuery, 2);
           if(false === str_contains( $params[0], '='))
           {
               return rtrim($params[0], '/');
           }
        }
        return '';
    }

    /**
     * Передача управления по текущему URL
     *
     * @param string $currentHTMLQuery Текущий URL запрос
     */
    public static function routeTransmission($currentHTMLQuery): void
    {
        $currentHTMLQuery = self::removeQueryString($currentHTMLQuery);
        if (self::routeComparison($currentHTMLQuery)) {
            $controller = 'app\controllers\\' . self::$route['admin_prefix'] . self::$route['controller'] . 'Controller';
            if (class_exists($controller)) {

                /** @var Controller $controllerObject */
                $controllerObject = new $controller(self::$route);

                $controllerObject->getModel();

                $action = self::lowCamelCase(self::$route['action'] . 'Action');
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else {
                    throw new \Exception("Метод {$controller}::{$action} не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер {$controller} не найден", 404);
            }

        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }
    /**
     * Сравнение текущего запроса с маршрутами в таблице маршрутов
     *
     * @param string $currentHTMLQuery Текущий URL запрос
     * @return bool Результат сравнения
     */
    public static function routeComparison($currentHTMLQuery): bool // Сравнение маршрутов
    {
        foreach (self::$routesTable as $pattern => $route) {
            if (preg_match("#{$pattern}#", $currentHTMLQuery, $matches)) {
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $route[$key] = $value;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                if (!isset($route['admin_prefix'])) {
                    $route['admin_prefix'] = '';
                } else {
                    $route['admin_prefix'] .= '\\';
                }
                $route['controller'] = self::upCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    protected static function upCamelCase($nameURL): string
    {
        // up-camel-case => up camel case
        $nameURL =  str_replace('-', ' ', $nameURL);
        // up camel case => Up Camel Case
        $nameURL =  ucwords($nameURL);
        // Up Camel Case => UpCamelCase
        $nameURL = str_replace(' ', '', $nameURL);
        return $nameURL;
    }
    protected static function lowCamelCase($name): string
    {
        return lcfirst(self::upCamelCase($name));
    }
}