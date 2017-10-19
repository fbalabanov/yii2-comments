<?php

return [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'demo/index',
    'controllerNamespace' => 'fbalabanov\yii\module\Comments\tests\web\controllers',
    'bootstrap' => [],
    'aliases' => [
        '@vendor/fbalabanov/yii2-comments' => realpath(__DIR__ . '/../../..'),
        '@vendor' => realpath(__DIR__ . '/../../../vendor'),
        '@bower' => realpath(__DIR__ . '/../../../vendor/bower'),
    ],
    'modules' => [
        'comments' => [
            'class' => 'fbalabanov\yii\module\Comments\Module',
            'userIdentityClass' => 'fbalabanov\yii\module\Comments\tests\web\models\User',
            'useRbac' => false,
        ],
    ],
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'request' => [
            'cookieValidationKey' => 'secret-key',
        ],
        'user' => [
            'identityClass' => 'fbalabanov\yii\module\Comments\tests\web\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => [],
];
