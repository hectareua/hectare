<?php

namespace app\modules\api;

use Yii;
use yii\web\Response;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $this->layout = false;
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }
}
