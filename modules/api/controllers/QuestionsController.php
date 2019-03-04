<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\ProductQuestion;
use yii\data\ActiveDataProvider;

class QuestionsController extends ApiController
{
	public function actionAsk()
	{
		$question = new ProductQuestion();
		$data = Yii::$app->request->post();
		$data['asked_at'] = new \yii\db\Expression('NOW()');
		$question->setAttributes($data);
		if (!$question->save())
		{
			return ['success' => false, 'errors' => $question->getErrors()];
		}
		return ['success' => true];
	}
}
