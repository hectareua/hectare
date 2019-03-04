<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\Forum;
use app\models\ForumMessage;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class ForumController extends ApiController
{
	public function actionIndex()
	{
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Forum::find(),
        ]);
	}

	public function actionCreate()
	{
		$auth_key = Yii::$app->request->post('auth_key');
		if (!$auth_key)
			return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
		$user = User::findOne(['auth_key' => $auth_key]);
		if (!$user)
			return ['success' => false, 'status' => 403, 'error' => 'Access denied'];

		$transaction = Yii::$app->db->beginTransaction();
		try
		{
			$data = Yii::$app->request->post('forum');
			$data['user_id'] = $user->id;
			$data['created_at'] = new \yii\db\Expression('NOW()');
			$forum = new Forum();
			$forum->setAttributes($data);
			if (!$forum->save())
			{
				return ['success' => false, 'errors' => ['forum' => $forum->getErrors()]];
			}
			$data = Yii::$app->request->post('forumMessage');
			if (!empty($data))
			{
				$data['created_at'] = new \yii\db\Expression('NOW()');
				$data['user_id'] = $user->id;
				$data['forum_id'] = $forum->id;
				$forumMessage = new ForumMessage();
				$forumMessage->setAttributes($data);
				if (!$forumMessage->save())
				{
					return ['success' => false, 'errors' => ['forumMessage' => $forumMessage->getErrors()]];
				}
			}
			$transaction->commit();
		}
		catch(\Exception $e)
		{
			$transaction->rollBack();
			throw $e;
		}

		return ['success' => true];
	}
}