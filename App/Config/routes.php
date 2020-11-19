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
    'register/activation/{token:\w+}' => [
        'controller' => 'register',
        'action' => 'activation'
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
    'user/{id:\w+}/update' => [
        'controller' => 'user',
        'action' => 'update'
    ],
    'user/{id:\w+}/delete' => [
        'controller' => 'user',
        'action' => 'delete'
    ],
);