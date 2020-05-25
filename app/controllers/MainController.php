<?php

namespace app\controllers;
use components\Pagination;
class MainController extends Controller
{
    public function indexAction()
    {
        # Сортировка
        $sort = '';
        $order = 'asc';
        if ( isset($_GET['sortby']) )
        {
            $sort = 'ORDER BY ' . $this->model->mysqli->real_escape_string($_GET['sortby']);
            if ( isset($_GET['order']) )
            {
                if( $_GET['order'] == 'asc' )
                {
                    $order = 'desc';
                }
                elseif ( $_GET['order'] = 'desc' )
                {
                    $order = 'asc';
                }
                $sort = 'ORDER BY ' . $this->model->mysqli->real_escape_string($_GET['sortby']) .' '.strtoupper($order);

            }
        }
        $this->setMeta("BeeJee - Список задач");
        # Запрос на выборку всех данных из таблицы
        $query = "SELECT * FROM ". DB_PREFIX . "task_list";
        # Создание пагинации
        # GET - параметр текущей страницы
        $page = isset( $_GET['page'] ) ? (int)$_GET['page'] : 1;
        # Скользо записей выводить на страницу. Параметр указан в файле config
        $perpage = \PAGINATION;
        # Общее количество записей
        $total = $this->model->mysqli->query($query)->num_rows;
        # Передача заданных параметров в класс пагинации. Переменная в котором хранится построенная пагинация
        $pagination = new Pagination($page, $perpage, $total);
        # С какой записи делать выборку
        $start = $pagination->getStart();
        # Выборка с параметрами пагинации
        $taskQuery = "SELECT * FROM ". DB_PREFIX . "task_list " . $sort . " LIMIT $start, $perpage";
        # Проверка результата выборки
        # Если результат возвращает пустоту оповещаем об этом пользователя выводя ошибку
        if ( !$result = $this->model->mysqli->query($taskQuery) )
        {
            $_SESSION['error'] = 'Ошибка выборки. '; $this->model->mysqli->error;
        }
        # Если есть запись проходимся по ним в цикле и добавляем знаяения в новую переменную
        while ($rows = $result->fetch_object())
        {
            $task_list[] = $rows;
        }
        $result->free();
        # Передача переменных в шаблон
        $this->set( compact('task_list', 'pagination', 'order') );
    }
}