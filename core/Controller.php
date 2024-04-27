<?php

namespace core;

abstract class Controller
{
    public array $data = [];
    public array $metaData = [];
    public false|string $layout = ''; // false если не требуется применять шаблон к странице, например при ajax запросах.
    public string $view = '';
    public object $model;

    public function __construct(public $route = [])
    {
       // debug($this->route);

    }
    public function getmodel()
    {
        $model = 'app\model\\' . $this->route['admin_prefix'] . $this->route['controller'];
        if(class_exists($model))
        {
            $this->model = new $model();
        }

    }

    public function getView(): void
    {
       $this->view = $this->view ?: $this->route['action']; // проверяем не переопределено ли свойства 'вида' view
        // Создаем объект View с необходимыми параметрами
        $view = new View($this->route, $this->layout, $this->view, $this->metaData);
        // Рендерим вид, передавая ему данные для отображения
        $view->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMetaData($title = '', $description = '', $keywords = '')
    {
        $this->metaData = [
            'title'=>$title,
            'description'=>$description,
            'keywords'=>$keywords,
        ];

    }

}