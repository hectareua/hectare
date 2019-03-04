<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductQuestion;
use app\models\UserReview;
use app\models\CallRequest;
use app\models\ProductPricesEnquiry;
use yii\helpers\Url;

class FormsController extends Controller
{
    public function actionIndex()
    {
        $formsData = [
            ['name' => 'Питання до продуктів', 'route' => 'product-question/index', 'count' => ProductQuestion::find()->count()],
            ['name' => 'Відгуки користувачів', 'route' => 'user-review/index', 'count' => UserReview::find()->count()],
            ['name' => 'Замовлення на дзвінок', 'route' => 'call-request/index', 'count' => CallRequest::find()->count()],
            ['name' => 'Питання про партнерьскі ціни', 'route' => 'product-prices-enquiry/index', 'count' => ProductPricesEnquiry::find()->count()],
        ];
        $forms = [];
        foreach ($formsData as $formData)
            $forms[] = ['label' => $formData['name'] . " (" . $formData['count'] . ")", 'url' => Url::to([$formData['route']])];
        return $this->render('index', compact('forms'));
    }
}
