<?php

namespace app\models;

class UserModel extends Model
{
    public $attributes = [
        'username' => '',
        'password' => '',
    ];

    public $rules = [
        'required' => [
            ['username'],
            ['password'],
        ],
    ];

    public function login()
    {
        $login = !empty( trim($_POST['username']) ) ? trim($_POST['username']) : null;
        $password = !empty( trim($_POST['password']) ) ? trim($_POST['password']) : null;
        if ( $login && $password )
        {
            $result = $this->mysqli->query("SELECT * FROM {$this->db_prefix}user WHERE login = '$login'");
            $user = $result->fetch_assoc();
            if ( $user )
            {
                if ( password_verify( $password, $user['password'] ) )
                {
                    foreach ( $user as $k => $v )
                    {
                        if ( $k != 'password' ) $_SESSION['user'][$k] = $v;
                    }
                    $result->free();
                    return true;
                }
            }
        }
    }

}