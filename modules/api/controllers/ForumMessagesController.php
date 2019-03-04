<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\Forum;
use app\models\User;
use app\models\ForumMessage;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

class ForumMessagesController extends ApiController
{
	public function actionIndex($forum_id)
	{
		$forum = Forum::findOne($forum_id);
		if (!$forum)
			return '';

		$forum->updateCounters(['views' => 1]);

        $result = [];
        $result[] = [
            'id' => -$forum->id,
            'forum_id' => $forum->id,
            'created_at' => strtotime($forum->created_at),
            'user' => $forum->user,
            'text' => $forum->text,
        ];

		$result = array_merge($result, ForumMessage::find()->where(['forum_id' => $forum->id])->all());

        return $result;
	}

	public function actionCreate()
	{
		$auth_key = Yii::$app->request->post('auth_key');
		if (!$auth_key)
			return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
		$user = User::findOne(['auth_key' => $auth_key]);
		if (!$user)
			return ['success' => false, 'status' => 403, 'error' => 'Access denied'];

		$data = Yii::$app->request->post('forumMessage');
		$data['created_at'] = new \yii\db\Expression('NOW()');
		$data['user_id'] = $user->id;
		$forumMessage = new ForumMessage();
		$forumMessage->setAttributes($data);
		if (!$forumMessage->save())
		{
			return ['success' => false, 'errors' => $forumMessage->getErrors()];
		}

		return ['success' => true];
	}
}
