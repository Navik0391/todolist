<?php

namespace app\controllers;
use app\models\TaskModel;

class TaskController extends Controller
{
    public function addAction()
    {
        $this->setMeta('BeeJee - Добавление новой задачи');

        if ( !empty($_POST) )
        {
            $task = new TaskModel();
            $data = $_POST;
            $task->load($data);
            if ( !$task->validate($data) )
            {
                $task->getErrors();
                $_SESSION['form_data'] = $data;
            }
            else
            {
                $rows = 'username, email, text';

                foreach ( $data as $datum )
                {
                    $value[] = '"' . $this->model->mysqli->real_escape_string( str_replace("'", '"', htmlspecialchars($datum, ENT_QUOTES)) ) . '"';
                }
                $values = implode(',', $value);

                if ( $task->save(DB_PREFIX.'task_list', $rows, $values) )
                {
                    $_SESSION['success'] = 'Данные успешно добавлены.';
                }
                else
                {
                    $task->getErrors();
                }
            }
            redirect();
        }
    }

    public function editAction()
    {
        if ( isset ($_SESSION['user']) )
        {
            if ( !empty($_GET['id']) )
            {
                $id = intval($_GET['id']);
                $query = "SELECT * FROM " . DB_PREFIX . "task_list WHERE task_ID=$id";
                $result = $this->model->mysqli->query($query);
                $data = $result->fetch_assoc();
                $result->free();
                if ( !empty($_POST) )
                {
                    $editTask = new TaskModel();
                    $text = $this->model->mysqli->real_escape_string( str_replace("'", '"', htmlspecialchars($_POST['text'], ENT_QUOTES)) );
                    $id = "task_ID=$id";
                    $sql = 'text="'.$text.'",status="1",edited="1"';
                    if ( $editTask->update(DB_PREFIX.'task_list', $id, $sql) )
                    {
                        $_SESSION['success'] = 'Данные успешно обновлены.';
                        redirect();
                    }
                    else
                    {
                        $editTask->getErrors();
                    }
                }
            }else header("Location: /");
        }
        else {
            $_SESSION['error'] = 'Вы должны авторизоваться.';
            redirect();
        }

        $this->setMeta('BeeJee - Редактирование задачи');
        $this->set( compact('data') );
    }

    public function changeStatusAction()
    {
        if ( !empty($_POST) )
        {
            $id = intval($_POST['task_id']);
            $status = new TaskModel();
            $query = "SELECT status FROM " . DB_PREFIX . "task_list WHERE task_ID=$id";
            $row = $this->model->mysqli->query($query)->fetch_assoc();
            if ( $row['status'] == 1 )
            {
                $sql = "status='0'";
            }
            else
            {
                $sql = "status='1'";
            }
            $id = "task_ID=$id";
            if ( $status->update(DB_PREFIX.'task_list', $id, $sql) )
            {
                $_SESSION['success'] = 'Данные успешно обновлены.';
                redirect();
            }
            else
            {
                $status->getErrors();
                header("Location: /");
            }
        }
        header("Location: /");
    }
}