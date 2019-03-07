<?php
Yii::setAlias('@app/services', dirname(__DIR__) . '/services');

function d($e){echo "<xmp>";print_r($e);echo "</xmp>";}
function _d($e){d(debug_backtrace()[0]['file'].":".debug_backtrace()[0]['line']);d($e);exit;}


$config = [
    'aliases' => [
        '@bower' => '@app/vendor/bower',
    ],

    'modules' => [
        'documentflow' => [
            'class' => 'app\modules\documentflow\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'components' => [
                'errorHandler' => [
                    'class' => '\yii\web\ErrorHandler',
                    'errorAction' => 'default/error',
                ],
            ],
        ],
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
        'web' => [
            'class' => 'app\modules\web\Module',
            'components' => [
                'errorHandler' => [
                    'class' => '\yii\web\ErrorHandler',
                    'errorAction' => 'web/default/error',
                ],
            ],
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ],
    ],
    'components' => [
		'feedsManufacture' => [
			'class' => 'app\components\feedManufacture\FeedManufacture',
		],
        'uploadComponent' => [
			'class' => 'app\modules\documentflow\components\uploadDocuments\uploadWidgetDocument',
        ],
        'documentflow' => [
            'class' => 'app\modules\documentflow\components\Document',
        ],
        'epochtasms'=>[
            'class' => 'pashkinz92\epochtasms\EpochtaClass',
            'sms_key_private' => 'dfc65562458f96f63aef7a5a0fe91562',
            'sms_key_public' => '59deb1a9ef5273d7c2a041ee5c993584',
            'name_sender' => 'name_sender',
            'testMode' => false, //Включение тестового режима
        ],

        'thumbnail' => [
            'class' => 'sadovojav\image\Thumbnail',
            'cachePath' => '@webroot/upload/thumbnail'
        ],

        'request' => [
            'cookieValidationKey' => 'asdasd',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],

        ],
        'pp' => app\services\PayPartsBuilder::build(
            [
                'class' => 'PayParts\PayParts',
                'storeId' => 'D84189EF0D144ABB82AF',
                'password' => '99c7c5fa08844b4287538453ab102803'
            ]
        ),
        'errorHandler' => [
            'class' => '\yii\web\ErrorHandler',
            'errorAction' => 'web/default/error',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['admin/default/login'],
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            'languages' => ['uk', 'ru'],
            'enablePrettyUrl' => true,
            'enableLanguageDetection' => false,
            'enableLanguagePersistence' => false,
            'showScriptName' => false,
            'ignoreLanguageUrlPatterns' => [
                '#^RU/#' => '#^RU/#',
                '#^rU/#' => '#^rU/#',
                '#^Ru/#' => '#^Ru/#',
                '#^admin/#' => '#^admin/#',
                '#^api/#' => '#^api/#',
            ],
            'rules' => require(__DIR__ . '/routes.php'),
        ],
        'pushcomponent' => [
            'class' => 'app\components\Push'
        ],
        'googleMapComponent' => [
            'class' => 'app\components\GoogleMapComponent',
            'key' => 'AIzaSyCPt2jxdUVUrHrdQip_2ldGwQ2MZDHSj1s',
        ],
    ],

    'on beforeRequest' => function () {
        $pathInfo = Yii::$app->request->pathInfo;
//       var_dump($pathInfo); die;
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/' && strpos($pathInfo, 'api/') === false) {
            return Yii::$app->response->redirect('/' . substr(rtrim($pathInfo), 0, -1), 301);
        }
//        if (!empty($pathInfo) && strpos($pathInfo, '112-z-dnem-konstitutsiji-ukrajini'))    {
//            //die('/' . str_replace('112-z-dnem-konstitutsiji-ukrajini', 'z-dnem-konstitutsiji-ukrajini', $pathInfo));
//            Yii::$app->response->redirect('/' . str_replace('112-z-dnem-konstitutsiji-ukrajini', 'z-dnem-konstitutsiji-ukrajini', $pathInfo), 301);
//        }
        if (!empty($pathInfo) && strpos($pathInfo, 'novosti') && strpos($pathInfo, 'api/') === false) {
            return Yii::$app->response->redirect('/' . str_replace('novosti', 'novini', $pathInfo), 301);
        }

    },
];


if (YII_ENV_DEV || true) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '52.174.154.151','159.224.0.225'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '52.174.154.151','159.224.0.225'],
    ];
}


return $config;
