<?php

function d($e){print_r($e);echo "\n";}
function _d($e){d($e);exit;}

Yii::setAlias('@app/components', dirname(__DIR__) . '/components');
Yii::setAlias('webroot', realpath(dirname(__FILE__).'/../web/'));
Yii::setAlias('web', '/');

return [
    'id' => 'hectare-console',
    'controllerNamespace' => 'app\commands',
    'components' => [
        'urlManager' => [
            'scriptUrl' => '@web/index.php',
            'hostInfo' => 'http://hectare/',
        ],
        'parser' => app\components\parser\ParserBuilder::build(
                ['class' => 'app\components\parser\XmlParce'],
                ['path' => 'xml/'],
                ['fileDataLoadSeccess' => function ($event) {}]
         )
    ],
];
