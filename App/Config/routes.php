<?php

return array(
    '' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    // Login, Register
    'login' => [
        'controller' => 'login',
        'action' => 'index'
    ],
    'login/logout' => [
        'controller' => 'login',
        'action' => 'logout'
    ],
    'register' => [
        'controller' => 'register',
        'action' => 'index'
    ],
    'register/activation/{token:\w+}/{id:\w+}' => [
        'controller' => 'register',
        'action' => 'activation'
    ],

    // Users
    'user/list' => [
        'controller' => 'user',
        'action' => 'list'
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

    // Articles
    'article/list' => [
        'controller' => 'article',
        'action' => 'list'
    ],
    'article/{id:\w+}' => [
        'controller' => 'article',
        'action' => 'index'
    ],
    'article/create/new' => [
        'controller' => 'article',
        'action' => 'create'
    ],
    'article/{id:\w+}/update' => [
        'controller' => 'article',
        'action' => 'update'
    ],
    'article/{id:\w+}/delete' => [
        'controller' => 'article',
        'action' => 'delete'
    ],
);