<?php

namespace app\modules\web\controllers;

use Yii;
use app\models\News;
use app\models\Category;
use yii\data\Pagination;

class TestController extends Controller 
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
        $pathInfo = Yii::$app->request->pathInfo;
        echo $pathInfo;
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
           Yii::$app->response->redirect('/' . substr(rtrim($pathInfo), 0, -1), 301);
            }
        $models = News::findPublishedNews()
        ->orderBy('publishing_since DESC');
        $pagination = new Pagination(['totalCount' => $models->count(), 'pageSize' => 5, 'defaultPageSize' => 5,]);
        $numberPages = $pagination->getPageCount();
        $page = \Yii::$app->request->get('page', 1);
        
        $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', compact('models', 'pagination', 'page', 'numberPages'));
        
    }
}