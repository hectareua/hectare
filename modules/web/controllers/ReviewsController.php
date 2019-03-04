<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\Review;
use app\models\Category;
use app\models\Like;
use app\models\Manufacturer;
use app\modules\web\models\ReviewForm;

class ReviewsController extends Controller
{
    
    public function beforeAction($action) {
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;
        
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
		$this->enableCsrfValidation = false;
        if((\Yii::$app->request->isPost) && (!isset(Yii::$app->request->post()['chk']))) {
            $secret = '6LdHFxIUAAAAAKxvXOogBoI8TfGCh_npL59nwM2p';
            $captcha = trim( \Yii::$app->request->post('g-recaptcha-response') );
            $ip = \Yii::$app->request->userIP;
            $url = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$captcha}&remoteip={$ip}";
            $options=array(
                'ssl'=>array(
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                ),
            );
            $context = stream_context_create( $options );
            $res=json_decode( file_get_contents( $url, FILE_TEXT, $context ) );
            if( $res->success ){

            } else {
                die('Вы робот :(');
            }
        }
        $model = new ReviewForm();
        if ($model->load(Yii::$app->request->post())){
    		$model->posted_at = new \yii\db\Expression('NOW()');
    		$model->is_visible = (int)!Yii::$app->params['review.shouldBeModerated'];
            $model->phone = \app\helpers\PhoneDigits::get($model->phone);
            if (!Yii::$app->user->isGuest)
                $model->user_id = Yii::$app->user->identity->id;
    		if ($model->save())
    		{
                $model->trigger(Review::EVENT_ON_CREATE);
                return $this->redirect(['reviews/index']);
    		}
        }

        $subQuery = Review::find()
            ->select([ "COUNT(*) as likes","review.id as review_id"])
            ->join('LEFT JOIN','like', 'review.id = like.review_id')
            ->where(['like.type' => 1])
            ->groupBy("review.id");
			
			
        $subQueryTwo = Review::find()
            ->select([ "COUNT(*) as dislikes","review.id as review_id"])
            ->join('LEFT JOIN','like', 'review.id = like.review_id')
            ->where(['like.type' => 0])
            ->groupBy("review.id");

		
			
         $reviews = Review::find()
             ->select(["T.likes as likes","K.dislikes as dislikes","review.*"])
             ->leftJoin(['T' => $subQuery], 'T.review_id = review.id')
             ->leftJoin(['K' => $subQueryTwo], 'K.review_id = review.id')
             ->where([
             'product_id' => null,
             'is_visible' => true,
             'parent_id' => null,
         ])->orderBy('posted_at DESC')->all();

         $manufacter = Manufacturer::findOne(['id' => Yii::$app->user->identity->ctypeid]);
//         echo '<pre>';
//         print_r($manufacter);
//         echo '</pre>';
//         die;

//        $reviews = Review::find()->where([
//            'product_id' => null,
//            'is_visible' => true,
//            'parent_id' => null,
//        ])->orderBy('posted_at DESC')->all();

        return $this->render('index', compact('reviews', 'model', 'manufacter'));
    }

    public function actionEdit()
    {
        if (!Yii::$app->request->post('id'))
            throw new \yii\web\HttpException(400, 'Bad request');
        if (Yii::$app->user->isGuest)
            throw new \yii\web\HttpException(403, 'Access denied');
        $id = Yii::$app->request->post('id');
        $review = ReviewForm::findOne($id);
        if (!$review)
            return $this->redirect(Url::toRoute(['@web/default/error']));
            throw new \yii\web\HttpException(404, 'Not found');
        if ($review->user_id != Yii::$app->user->identity->id)
            throw new \yii\web\HttpException(403, 'Access denied');

        $review->text = Yii::$app->request->post('text');
        $review->save();
    }

    public function actionAddLike($id, $type) {
	
	  if(!Yii::$app->user->isGuest){

        $model = new Like;
        $review_id = (integer)$id;
        $type = (int)$type;
        $user_id = Yii::$app->user->id;
//        $user_ip = !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']:'';

        $already_exist  = Like::find()->where(['review_id' => $id])->all();
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
            $model->review_id = $id;
            $model->type = $type;
            $model->user_id = $user_id;
            $model->save();
        }
		
		}
        $reviews = Like::find()->select(['type'])->where(['review_id' => $id])->all();
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

    public function actionReply()
    {
        if (!Yii::$app->request->post('id'))
            throw new \yii\web\HttpException(400, 'Bad request');
        if (Yii::$app->user->isGuest)
            throw new \yii\web\HttpException(403, 'Access denied');
        if (!Yii::$app->user->identity->is_admin)
            throw new \yii\web\HttpException(403, 'Access denied');
        $id = Yii::$app->request->post('id');
        $review = ReviewForm::findOne($id);
        if (!$review)
            throw new \yii\web\HttpException(404, 'Not found');

        $model = new ReviewForm();
        $model->name = "";
        $model->email = "";
        $model->text = Yii::$app->request->post('text');

        $model->posted_at = new \yii\db\Expression('NOW()');
        $model->is_visible = true;
        $model->user_id = Yii::$app->user->identity->id;
        $model->parent_id = $id;
        if ($model->save(false))
        {
            // $model->trigger(Review::EVENT_ON_CREATE);
        }
    }

    public function replyComments($arr, $model, $manufacter){
        if (is_array($arr)) {
            foreach ($arr as $reply) {
                echo $this->renderAjax('reply', compact('reply', 'model', 'manufacter'));
                self::replyComments($reply->replies, $model, $manufacter);
            }
        }
    }
}
