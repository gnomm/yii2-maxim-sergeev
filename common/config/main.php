<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'bootstrap' => ['CreateProjectEventComponent', 'CreateTaskEventComponent'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'bot' => [
            'class' => \SonkoDmitry\Yii\TelegramBot\Component::class,
            'apiToken' => ''
        ],
        'CreateProjectEventComponent' => [
            'class' => \common\components\CreateProjectEventComponent::class
        ],
        'CreateTaskEventComponent' => [
            'class' => \common\components\CreateTaskEventComponent::class
        ],
//        'user' => [
//            'identityClass' => 'common\models\User',
//            'enableAutoLogin' => true,
//            'identityCookie' => [
//                'name' => '_identity-backend',
//                'httpOnly' => true
//            ],
//        ],
//        'session' => [
//            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
//        ],
    ],
];
