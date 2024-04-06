<?php

namespace core;

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
     * Передача управления по текущему URL
     *
     * @param string $currentHTMLQuery Текущий URL запрос
     */
    public static function routeTransmission($currentHTMLQuery): void
    {
        if(self::routeComparison($currentHTMLQuery))
        {
            echo 'OK';
        }else
        {
            echo 'NO';
        }
    }
    /**
     * Сравнение текущего запроса с маршрутами в таблице маршрутов
     *
     * @param string $currentHTMLQuery Текущий URL запрос
     * @return bool Результат сравнения
     */
    public static function routeComparison($currentHTMLQuery): bool
    {
        foreach (self::$routesTable as $pattern => $route)
        {
            if(preg_match("#$pattern#i", $currentHTMLQuery, $matches))
            {
                return true;
            }
        }
        return false;
    }

}
