<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\Forum;
use app\models\ForumMessage;
use app\models\Category;
use yii\data\Pagination;

class ForumController extends Controller
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
        throw new \yii\web\NotFoundHttpException();
        $models = Forum::find();
        $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 5]);
        $numberPages = $pagination->getPageCount();
        $page = \Yii::$app->request->get('page', 1);
        $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', compact('models', 'pagination', 'page', 'numberPages'));
    }

    public function actionView($forum_id)
    {
        throw new \yii\web\NotFoundHttpException();
        $model = Forum::findOne(['slug' => $forum_id]);
        if (!$model)
            $model = Forum::findOne($forum_id);
        if (!$model)
            throw new \yii\web\NotFoundHttpException();

        $message = new ForumMessage();
        if (!Yii::$app->user->isGuest && $message->load(Yii::$app->request->post())){
    		$message->forum_id = $model->id;
    		$message->created_at = new \yii\db\Expression('NOW()');
            $message->user_id = Yii::$app->user->identity->id;
    		if ($message->save())
    		{
                $message->trigger(ForumMessage::EVENT_ON_CREATE);
                return $this->redirect(['view', 'forum_id' => $forum_id]);
    		}
        }
        return $this->render('view', compact('model', 'message'));
    }
}
