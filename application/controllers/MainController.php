<?php
namespace app\controllers;

use core\Controller;

class MainController extends Controller
{
    public false|string $layout = 'TEST'; // Здесь переопределяется шаблон(макет) для всего приложения
    public function indexAction() // Здесь переопределяется шаблон(макет) для конкретной страницы
    {
       $this->layout = 'test';
    }
}