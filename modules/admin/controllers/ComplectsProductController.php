<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Complects;
use app\models\ComplectsProduct;
use app\models\AttributeValue;
use app\models\Product;
use app\modules\admin\models\ComplectsProductSearch;
use app\modules\admin\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * ComplectsProductController implements the CRUD actions for model.
 */
class ComplectsProductController extends Controller
{
    /**
     * Lists all country models.
     * @return mixed
     */
    public function actionIndex()
    { 
		$searchModel = new ComplectsProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');
        $complect = ArrayHelper::map(Complects::find()->all(), 'id', 'name');

        return $this->render('index', [
            'product' => $product,
            'complect' => $complect,
            'attributeValue' => $attributeValue,
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
        $complect = ArrayHelper::map(Complects::find()->all(), 'id', 'name');
        $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product' => $product,
            'attributeValue' => $attributeValue,
            'complect' => $complect
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionCreate()
    {
        $model = new ComplectsProduct();
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk'); 
        $complect = ArrayHelper::map(Complects::find()->all(), 'id', 'name'); 
        $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');     

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
				'attributeValue' => $attributeValue,
				'complect' => $complect        
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $complect = ArrayHelper::map(Complects::find()->all(), 'id', 'name');
        $attributeValue = ArrayHelper::map(AttributeValue::find()->all(), 'id', 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
				'model' => $model,
				'product' => $product, 
				'attributeValue' => $attributeValue,
				'complect' => $complect 
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = ComplectsProduct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
