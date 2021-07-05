<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@docs'  => '@app/web/docs',
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\ApiModule',
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'psSW_edxfLdZ_mJ2rnuNVgKhfmSvqx0j',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'suffix' => '/',
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'normalizeTrailingSlash' => true,
                'collapseSlashes' => true,
            ],
            'rules' => [
                '/' => 'site/index',
                '<controller:\w+>/<action:exportAll>' => '<controller>/export-all',
                '<controller:\w+>/<action:exportSubnet>' => '<controller>/export-subnet',
                '<controller:\w+>/<action:(\w+)>' => '<controller>/<action>',
                '<controller:\w+>/<action:(\w+)><ip:>' => '<controller>/<action>',
                'POST <controller:mac>/<action:switch>' => '<controller>/<action>',

                'POST <module:api>/<controller:mac>/<action:generate>' => '<module>/<controller>/<action>',
                'GET <module:api>/<controller:mac|ip>/<action:getById>/<id:\d+>' => '<module>/<controller>/get-by-id',
                'GET <module:api>/<controller:mac>/<action:getByIp>/<ip:>' => '<module>/<controller>/get-by-ip',
                'GET <module:api>/<controller:mac|ip>/<action:list>' => '<module>/<controller>/<action>',
                'POST <module:api>/<controller:mac>/<action:changeStatus>' => '<module>/<controller>/change-status',
                'GET <module:api>/<controller:ip>/<action:getBySubnet>' => '<module>/<controller>/get-by-subnet',

                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<module:\w+><controller:\w+>/<action:update|delete>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
