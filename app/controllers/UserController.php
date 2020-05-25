<?php

namespace app\controllers;

use app\models\UserModel;

class UserController extends Controller
{
    public function loginAction()
    {
        $this->setMeta('BeeJee - Вход');

        if ( !isset($_SESSION['user']) )
        {
            if ( !empty($_POST) )
            {
                $user = new UserModel();
                if ( $user->login() )
                {
                    $_SESSION['success'] = 'Вы успешно авторизованы.';
                    header("Location: /");
                }
                else
                {
                    if ( $_POST['username'] == "" || $_POST['password'] == "" ) {
                        $_SESSION['error'] = 'Поля обязательны для заполнения.';
                    }else $_SESSION['error'] = 'Введенные данные не верны.';
                }
                redirect();
            }
        } else header("Location: /");

    }

    public function logoutAction()
    {
        if ( isset($_SESSION['user']) ) unset( $_SESSION['user'] );
        redirect();
    }
}