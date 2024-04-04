<?php

namespace core;

trait Single
{
private static self|null $instance = null; // создаем статичный метод который содержит либо объект либо null.
private function __construct (){}
public static function getInstance(): static
{
return static::$instance ?? static::$instance = new static(); // если есть, что то в static::$instance то вернем его. Иначе запишем в static::$instance новый экземпляр класса static.
}
}