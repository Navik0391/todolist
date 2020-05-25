<?php

namespace app\views;

class View
{
    public $route;
    public $controller;
    public $model;
    public $view;
    public $layout;
    public $meta = [];
    public $data = [];

    public function __construct($route, $view = '', $meta)
    {
        $this->route = $route;
        $this->controller = !empty($route['controller']) ? $route['controller'] : 'main';
        $this->model = $route['controller'];
        $this->view = !empty($view) ? $view : 'index';
        $this->meta = $meta;
        # Главный шаблон по умолчанию. Находится в папке views/ файл layout.php
        $this->layout = LAYOUT;
    }
    # Метод для передачи данных в определенный вид.
    public function render($data)
    {
        if ( is_array($data) ) extract($data);
        # Ищем запрощеный вид. В этом случае контроллер служит папка в которой находится вид
        $viewFile = __DIR__ . '/'. $this->controller. '/' . $this->view .'.php';
        if ( is_file($viewFile) )
        {
            ob_start();
            require_once $viewFile;
            $content = ob_get_clean();
        }
        else
        {
            throw new \Exception("View {$viewFile} not found", 404);
        }
        $layoutFile = __DIR__ . '/' . $this->layout;
        if ( is_file( $layoutFile ) )
        {
            require_once $layoutFile;
        }
        else
        {
            throw new \Exception("Template {$layoutFile} not found", 404);
        }

    }

    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>'. PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['description'] . '">'. PHP_EOL;
        $output .= '<meta name="keywords" content="'. $this->meta['keywords'] .'">'. PHP_EOL;
        return $output;
    }

}