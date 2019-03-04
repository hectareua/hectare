<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\AnonymusPush;
use app\models\Product;
use app\models\News;
use app\models\User;
use app\models\Category;
use yii\data\ActiveDataProvider;

class TokenController extends ApiController
{

    public function actionTestNews()
    {
        News::findOne(['id' => 2])->sendPushNewNews();
    }

    public function actionTestItem() {
        Product::findOne(['discount' => 5])->sendPushSale();
        return Product::findOne(['discount' => 5]);
    }

    public function actionTest() {
        User::sendPushMessageToEveryone('test', 'test', 'test');
    }

    public function actionIndex()
    {
      $apush = new AnonymusPush();
      $apush->push_token = Yii::$app->request->post('push_token');
      $apush->save();
    }
}
