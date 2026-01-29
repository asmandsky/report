<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Yii 1 App',

    // Явно задаём кодировку приложения
    'charset' => 'UTF-8',

    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.controllers.*',
        'application.views.*',
    ),

    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=db;port=3306;dbname=yii1db',
            'username' => 'yii1user',
            'password' => 'yii1pass',
            'charset' => 'utf8',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'caseSensitive' => false,
            'rules' => array(
                '' => 'site/index',  // главный экран
                'login' => 'login/index',
                'logout' => 'login/logout',
                'report' => 'report/TopAuthors',
                'report/<year:\d+>' => 'report/TopAuthors',
                'book/view/<id:\d+>' => 'book/view',
                'book/update/<id:\d+>' => 'book/update',
                'author/view/<id:\d+>' => 'author/view',
                'author/update/<id:\d+>' => 'author/update',
            ),
        ),
        'user' => array(
            'allowAutoLogin' => true,
            'loginUrl' => array('/login/index'),
        ),
        // Обработчик ошибок
        'errorHandler' => array(
            'errorAction' => '/site/error',
        ),
        // Настройки сессии
        'session' => array(
            'timeout' => 1800,
        ),
    ),
);


