<?php

namespace app\modules\web;

/**
 * web module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\web\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main';
    }
}
