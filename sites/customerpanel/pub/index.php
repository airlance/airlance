<?php
use yii\web\Application;

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__, 3));
defined('PANEL_PATH') or define('PANEL_PATH', ROOT_PATH . '/sites/customerpanel');
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . '/vendor');
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . '/runtime');

require(VENDOR_PATH . '/autoload.php');
require(VENDOR_PATH . '/yiisoft/yii2/Yii.php');

Yii::setAlias('@Services', ROOT_PATH . '/services');
$params = require_once ROOT_PATH . '/config/env.php';

$config = [
    'id' => 'app',
    'basePath' => PANEL_PATH,
    'vendorPath' => VENDOR_PATH,
    'runtimePath' => RUNTIME_PATH,
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'errorHandler' => [
            'errorAction' => 'common/error',
        ],
        'request' => [
            'baseUrl' => '',
            'cookieValidationKey' => $params['cookie.validation.key']
        ],
        'assetManager' => [
            'linkAssets' => true,
            'converter' => [
                'class' => 'yii\web\AssetConverter',
                'commands' => [
                    'less' => ['css', VENDOR_PATH . '/wikimedia/less.php/bin/lessc {from} {to} --no-color']
                ]
            ]
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8mb4',
            'dsn' => 'mysql:host=localhost;dbname=testing',
            'username' => $params['db.username'],
            'password' => $params['db.password']
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => []
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'log' => [
            'class' => 'yii\log\Dispatcher',
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error'],
                    'logFile' => RUNTIME_PATH . '/logs/panel-errors.log'
                ]
            ],
            'traceLevel' => YII_DEBUG ? 3 : 0
        ]
    ],
    'bootstrap' => [
        'log'
    ],
    'name' => 'Airlance',
    'language'=>'ru-RU',
    'timeZone'=>'Europe/Kiev',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
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

$application = new Application($config);
$application->run();