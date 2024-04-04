<?php

namespace core;

class Registry
{
    use Single;

    protected static array $Settings = [];

    public function setSetting($name, $value)
    {
        self::$Settings[$name] = $value;
    }

    public function getSetting($name)
    {
        return self::$Settings[$name] ?? null;
    }

    public function getAllSettings(): array
    {
        return self::$Settings;
    }
}