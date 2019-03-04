<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\Review;
use app\models\Like;
use app\models\User;
use yii\data\ActiveDataProvider;

class ReviewsController extends ApiController
{
	public function actionPost()
	{
		$review = new Review();
		$data = Yii::$app->request->post();
		$data['posted_at'] = new \yii\db\Expression('NOW()');
		$data['is_visible'] = (int)!Yii::$app->params['review.shouldBeModerated'];
		$review->setAttributes($data);
		if (!$review->save())
		{
			return ['success' => false, 'errors' => $review->getErrors()];
		}
		return ['success' => true];
	}

	public function actionAll($product_id = null)
	{
        return new ActiveDataProvider([
            'pagination' => false,
            'query' => Review::find()
                ->where(['product_id' => $product_id, 'is_visible' => true, 'parent_id' => null]),
        ]);
	}

    public function actionLike( )
    {
        $post = Yii::$app->request->post();
        $errors = [];
        $review_id = $post['review_id'];
        $type = $post['type'];
        $auth_key = $post['auth_key'];

        if(!$auth_key) $errors[] = 'auth_key is required';
        if(!$review_id) $errors[] = 'review_id is required';
        if(is_null($type)) $errors[] = 'type is required';
        if(((int)$type < 0 ||(int)$type > 1))  $errors[] = 'type must be 0 or 1';


        if ($errors) return ['success' => false, 'status' => 400, 'error' => $errors];

        $user = User::findOne(['auth_key' => $auth_key]);
        if (!($user && $user->client)) return ['success' => false, 'status' => 400, 'error' => 'unknown user'];



            $model = new Like;
            $review_id = (integer)$review_id;
            $type = (int)$type;
            $user_id = $user->id;

            $already_exist  = Like::find()->where(['review_id' => $review_id])->all();
            $check = false;
            foreach ($already_exist as $item){
                if ($item->user_id == $user_id && $item->type == $type){
                    \Yii::$app->db->createCommand("delete from `like` where `id` = :id")
                        ->bindValue(':id', $item->id)
                        ->execute();
                    $check = true;
                    break;
                }elseif ($item->user_id == $user_id){
                    \Yii::$app->db->createCommand("update `like` set `type` = :type where `id` = :id")
                        ->bindValue(':type', $type)
                        ->bindValue(':id', $item->id)
                        ->execute();
                    $check = true;
                    break;
                }
            }
            if (!$check) {
                $model->review_id = $review_id;
                $model->type = $type;
                $model->user_id = $user_id;
                $model->save();
            }


        $reviews = Like::find()->select(['type'])->where(['review_id' => $review_id])->all();
        $like = 0;
        $dislike = 0;
        foreach ($reviews as $review) {
            if ($review['type'] == 0){
                $dislike++;
            }else{
                $like++;
            }
        }
        $result = [
            'likes' => $like,
            'dislikes' => $dislike
        ];

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

}