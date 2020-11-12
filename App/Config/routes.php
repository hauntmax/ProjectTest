<?php

return array (
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    // Login, Register
    'login' => [
        'controller' => 'login',
        'action' => 'index'
    ],
    'register' => [
        'controller' => 'register',
        'action' => 'index'
    ],

    // Users
    'users' => [
        'controller' => 'users',
        'action' => 'index'
    ],
    'user/{id:\w+}' => [
        'controller' => 'user',
        'action' => 'index'
    ],
    'user/create/new' => [
        'controller' => 'user',
        'action' => 'create'
    ],
    'user/update/{id:\w+}' => [
        'controller' => 'user',
        'action' => 'update'
    ],
    'user/delete/{id:\w+}' => [
        'controller' => 'user',
        'action' => 'delete'
    ],
);