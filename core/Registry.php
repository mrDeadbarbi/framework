<?php

namespace core;

/**
 * Class Registry
 * Реестр настроек приложения
 */
class Registry
{
    use Single;  // Используем трейт Single для реализации паттерна Singleton

    /**
     * @var array Ассоциативный массив настроек
     */
    protected static array $Settings = [];

    /**
     * Установка значения настройки
     *
     * @param string $name Наименование настройки
     * @param mixed $value Значение настройки
     * @return void
     */
    public function setSetting($name, $value): void
    {
        self::$Settings[$name] = $value;
    }

    /**
     * Получение значения настройки по имени
     *
     * @param string $name Наименование настройки
     * @return mixed|null Значение настройки, либо null, если настройка не найдена
     */
    public function getSetting($name)
    {
        return self::$Settings[$name] ?? null;
    }

    /**
     * Получение всех настроек в виде массива
     *
     * @return array Массив всех настроек
     */
    public function getAllSettings(): array
    {
        return self::$Settings;
    }
}
