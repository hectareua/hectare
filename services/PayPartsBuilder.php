<?php

namespace app\services;

class PayPartsBuilder
{
    public static function build($config = [])
    {

        return function () use ($config) {
            $pp = \Yii::createObject($config['class'], [$config['storeId'], $config['password']]);
            //var_dump($pp);
            //exit;
            return $pp;
        };
    }
}
