<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Maincharact;
use app\models\Product;
use app\modules\admin\models\ProductSearch;
use app\modules\admin\models\MaincharactSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * MaincharactController implements the CRUD actions for model.
 */
class MaincharactController extends Controller
{
    /**
     * Lists all country models.
     * @return mixed
     */
    public function actionIndex()
    { 
		$searchModel = new MaincharactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');

        return $this->render('index', [
            'product' => $product,
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
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product' => $product
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionCreate()
    {
        $model = new Maincharact();
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');        

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
				'product' => $product      
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
				'model' => $model,
				'product' => $product      
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Maincharact::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
