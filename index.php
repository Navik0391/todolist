<?php
    error_reporting(E_ALL | E_STRICT);
    session_start();

    # Функция для автозагрузки классов
    if(!function_exists('classAutoLoader')){
        function classAutoLoader($class){
            $class=str_replace('\\', '/', $class)   ;
            $classFile= __DIR__ . '/' .$class.'.php';
            if(is_file($classFile)&&!class_exists($class)) include $classFile;
        }
    }
    spl_autoload_register('classAutoLoader');

    include 'components/config.php';
    include 'components/functions.php';

    # Начало маршрутизации. Маршрут будет сторится в виде /?r=main/index, где main - это контроллер, index - метод (можно и не указывать т.к. будет по умолчанию).
    # Также можно не указывать get параметр r
    # Для контроллеров и методов будет использоваться тип регистра CamelCase
    if (empty($_GET['r']))
    {
        # Контроллер по умолчанию
        $controller = 'app\controllers\MainController';
        # Метод по умолчанию
        $action = 'indexAction';
    }
    else
    {
        # Параметр по которому будет строится маршрут.
        $r = htmlspecialchars($_GET['r']);
        # Разбиваем параметр для получения контроллера и действия.
        $ext = explode('/', $r, '3');
        # Сохраняем полученное значение контроллера в переменной $controller. Переводим в нужный регистр первый символ
        $controller = 'app\controllers\\'.ucfirst($ext[0]).'Controller';
        # Сохраняем полученное значение метода в переменной $action. Если метод не задан, то будет использоваться метод по умолчанию indexAction
        $action = !empty($ext[1]) ? lcfirst($ext[1]).'Action' : 'indexAction';
        # Переводи метод в нужный регистр. Если передан маршрут типа test-test, то в этом случае строка переведется на нужный формат, т.е. testTestAction
        $action = lcfirst( str_replace(' ', '', ucwords( str_replace('-', ' ', $action ) ) ) );
        # Массив $route с параметрами маршрута для
        $route = ['controller' => $ext[0], 'action' => @$ext[1]];
    }
    try
    {
        # Если класс не найдет то ловим исключение
        if ( !class_exists($controller) )
        {
            throw new Exception("Class $controller not Found!", 404);
        }
        # Создаём новый $object переданного класса с маршрутом для шаблона
        $object = new $controller(@$route);
        # Если метод у класса не существует ловим исключение
        if ( !method_exists($object, $action) )
        {
            throw new Exception("Action not Found!", 404);
        }
        # Вызываем метод класса
        $object->$action();
        # Вызываем метод который будет подставлять нужный шаблон
        $object->getView();
    }
    # Выводим все сообщение об исключениях, если таковы будут
    catch ( Exception $e )
    {
        echo $e->getMessage();
    }