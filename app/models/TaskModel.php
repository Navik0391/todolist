<?php

namespace app\models;

class TaskModel extends Model
{
    public $attributes = [
        'username' => '',
        'email' => '',
        'text' => '',
    ];

    public $rules = [
        'required' => [
            ['username'],
            ['email'],
            ['text'],
        ],
        'email' => [
            'email' => true
        ],
    ];

}