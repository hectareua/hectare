<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Normy;
use app\models\Plants;
use app\models\Product;
use app\modules\admin\models\PlantsSearch;
use app\modules\admin\models\NormSearch;
use app\modules\admin\models\NormForm;
use app\modules\admin\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * NormController implements the CRUD actions for model.
 */
class NormController extends Controller
{
    /**
     * Lists all country models.
     * @return mixed
     */
    public function actionIndex()
    { 
		$searchModel = new NormSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');

        return $this->render('index', [
            'product' => $product,
            'plants' => $plants,
      //      'searchModel' => $searchModel,            
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single country model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');		
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product' => $product,
            'plants' => $plants     
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionCreate()
    {
        $model = new Normy();
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');	        

        if ($model->load(Yii::$app->request->post())) {
			if ($model->saveForm()) {
				if (isset(Yii::$app->request->post()['prod'])&&(Yii::$app->request->post()['prod']==1)) {
					return 'Створено!';
				} else {
					return $this->redirect(['view', 'id' => $model->id]);
				} 
			}
        } else {
            return $this->render('create', [
                'model' => $model,
				'product' => $product,
				'plants' => $plants              
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');	

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
				'model' => $model,
				'product' => $product,
				'plants' => $plants               
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Normy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
