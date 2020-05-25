<?php
namespace app\models;
use mysqli;
class Model
{
    public $mysqli;
    public $db_prefix = DB_PREFIX;
    # атрибуты данных из полей форм
    public $attributes = [];
    public $errors = [];
    # Правила по котором будет осуществлятся валидация форм
    public $rules = [];

    public function __construct()
    {
        $this->mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
        if ($this->mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
        $this->mysqli->set_charset('utf8');
    }
    # Метод для хранения атрибутов из POST и GET параметров.
    public function load($data)
    {
        foreach ( $this->attributes as $name => $value )
        {
            if( isset($data[$name]) )
            {
                $this->attributes[$name] = $data[$name];
            }
        }
    }
    # Метод для добавления записей в таблицу
    public function save($table, $rows, $values)
    {
        # Запрос на вставку строк
        $query = "INSERT INTO $table ($rows) VALUES ($values)";
        if ( $result = $this->mysqli->query($query) )
        {
            $this->mysqli->close();
            return true;
        }
        $this->errors['sql'] = "Ошибка при добавлении данных. Код ошибки: ". $this->mysqli->sqlstate . " (".$this->mysqli->error.") ";
        return false;
    }
    # Метод валидации
    public function validate()
    {
        # Проверка полей на заполнения
        foreach ($this->rules['required'] as $k => $v)
        {
            if ( $this->attributes[$v[0]] === '' )
            {
                $this->errors['require'] = "Поля обязательны для заполнения.";
                return false;
            }
        }
        # Проверка валидности поля email
        foreach ($this->attributes as $k => $v)
        {
            if (@$this->rules['email'][$k] == true)
            {
                if (!filter_var($this->attributes[$k], FILTER_VALIDATE_EMAIL))
                {
                    $this->errors['email'] = "Email не валиден.";
                    return false;
                }
            }
        }
        return true;
    }
    # Метод обновления записей. Получает название таблицы, ID по которой будет осуществляться запрос и сам зарос
    public function update($table, $id, $sql)
    {
        $query = "UPDATE $table SET $sql WHERE $id";
        if ( $this->mysqli->query($query) == true )
        {
            return true;
        }
        else
        {
            $this->errors['sql'] = "Ошибка при обновлении данных. Код ошибки: ". $this->mysqli->sqlstate . " (".$this->mysqli->error.") ";
            return false;
        }
        $this->mysqli->close();
    }
    # Вывод ошибок
    public function getErrors()
    {
        foreach ( $this->errors as $error )
        {
            $errors = $error;
        }
        $_SESSION['error'] = $errors;
    }
}