<?php

namespace app\commands;

use Yii;
use app\models\User;

class TestController extends \yii\console\Controller
{
    public function actionIndex()
    {
        User::sendPushMessageToEveryone("Test. Hello World");
    }
}
