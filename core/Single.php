<?php

namespace core;

/**
 * Trait Single
 * Одиночка (Singleton) в виде трейта
 */
trait Single
{
    /**
     * @var static|null Экземпляр класса
     */
    private static self|null $instance = null; // создаем статичный метод который содержит либо объект либо null.

    private function __construct (){}

    /**
     * Получение экземпляра класса (единственный доступный метод для получения объекта из трейта)
     *
     * @return static Экземпляр класса
     */
    public static function getInstance(): static
    {
        return static::$instance ?? static::$instance = new static(); // если есть, что-то в static::$instance, то вернем его. Иначе запишем в static::$instance новый экземпляр класса static.
    }
}
