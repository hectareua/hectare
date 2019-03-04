<?php

$params = array_merge(
    require(__DIR__ . '/params.php'),
    ((@include(__DIR__ . '/params-local.php')) ?: [])
);

return [
    'id' => 'hectare',
    'name' => 'Гектар',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'uk',
    'components' => [
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=test22',
            'username' => 'test22',
            'password' => 'i79q84i35m56i7n4',
            'charset' => 'utf8',
        ],
        'cache' => [
           // 'class' => 'yii\caching\FileCache',
           'class'=>'yii\caching\DummyCache',
        ],
        'push' => [
            'class' => 'app\components\Push',
            'apiKey' => 'AIzaSyA8HLrNXYZFMqXu3Sey5gsGcUaVvOrNo-c',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
    'params' => $params,
];
