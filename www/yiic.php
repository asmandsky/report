<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('YII_PATH') or define('YII_PATH', dirname(__FILE__) . '/framework/yii');

$migrationDir = dirname(__FILE__) . '/protected/migrations';

$config = array(
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=db;port=3306;dbname=yii1db',
            'username' => 'yii1user',
            'password' => 'yii1pass',
            'charset' => 'utf8',
        ),
    ),
);

require_once(YII_PATH . '/yiic.php');

