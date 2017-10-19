<?php
/**
 * main.php
 */

return [
    'id' => 'testapp',
    'basePath' => realpath(__DIR__ . '/..'),
    'modules' => [
        'comments' => [
            'class' => 'fbalabanov\yii\module\Comments\Module',
            'userIdentityClass' => 'fbalabanov\yii\module\Comments\tests\unit\models\User',
        ],
    ]
];