<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\Article;
use app\models\Category;
use yii\data\Pagination;

class ArticlesController extends Controller
{
    public function behaviors(){
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index','view'],
                'lastModified' => function ($action, $params) {
                        if ($this->action->id == 'index') {
                            $q = new \yii\db\Query();
                            return strtotime($q->from('news')->max('updated_at'));
                        }
                        else{
                        
                              $post = Article::findOne(\Yii::$app->request->get('article_id'));

                              
                           return strtotime($post->updated_at);
                             
                        }
                   
                },
            ],
        ];
    }
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
        $models = Article::findPublishedArticles()
            ->orderBy('publishing_since DESC');

        $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 5, 'defaultPageSize' => 5,]);
        $numberPages = $pagination->getPageCount();
        $page = \Yii::$app->request->get('page', 1);
        
        $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        
        $numberPages = $pagination->getPageCount();
        if($numberPages ==  0) {
            $numberPages = 1;
        }
        if($page > $numberPages || $page == 0) {
            throw new \yii\web\NotFoundHttpException();
        }
        return $this->render('index', compact('models', 'pagination', 'page', 'numberPages'));
    }

    public function actionView($article_id)
    {
        $pathInfo = Yii::$app->request->pathInfo;
        $model = Article::findOne(['slug' => $article_id]);
        if (!$model) {
            $model = Article::findOne($article_id);
        }

        if (!$model)
            throw new \yii\web\NotFoundHttpException();

        return $this->render('view', compact('model'));
    }
    
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
}
