<?php
namespace app\controllers;
use app\models\Model;
use app\views\View;
class Controller
{
    # объект $route в котором будет хранится массив
    public $route;
    public $model;
    public $controller = 'main';
    # Вид по умолчанию это метод в классе
    public $view = 'index';
    public $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    # Данные которые будут передаваться видам
    public $data = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->model = new Model();
        $this->controller = $route['controller'];
        $this->view = $route['action'];
    }

    public function getView()
    {
        # Создаём экземпляр класса вид и передаём маршрут (контроллер и метод) для вывода соответствующего вида
        $view = new View($this->route, $this->view, $this->meta);
        # Передаём данные в шаблон
        $view->render($this->data);
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['description'] = $description;
        $this->meta['keywords'] = $keywords;
    }
}