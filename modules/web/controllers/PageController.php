<?php
namespace app\modules\web\controllers;

use Yii;
use app\models\Page;
use app\models\Product;
class PageController extends Controller
{

      public function behaviors(){
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index','view'],
                'lastModified' => function ($action, $params) {
                        if ($this->action->id == 'index') {
                            $q = new \yii\db\Query();
                            return strtotime($q->from('product')->max('updated_at'));
                        }
                        else{
                        
                       $q = new \yii\db\Query();

                              return strtotime($q->from('product')->where(['category_id'=>Yii::$app->request->get('category_id')])->max('updated_at'));
                          
                             
                        }
                   
                },
    //            'etagSeed' => function ($action, $params) {
    //                return // generate etag seed here
    //            }
            ],
        ];
    }

    
    public function beforeAction($action) {
        $parentCategories = Page::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;
        
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        $saleProducts = $this->_loadSaleProductsModels();
        $models = Page::find()
            ->where(['parent_id' => null])
            ->orderBy('order')
            ->all();
        return $this->render('index', compact('models', 'saleProducts'));
    }

    public function actionView($category_id)
    {
        $category = Page::findOne(['slug' => $category_id]);
        if (!$category)
            $category = Page::findOne($category_id);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException();
        }
        $models = $category->categories;
        $parents = [];
        $parent = $category;
        while ($parent = $parent->parent)
            array_unshift($parents, $parent);
        return $this->render('view', compact('models', 'category', 'parents'));
    }
    
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
}
