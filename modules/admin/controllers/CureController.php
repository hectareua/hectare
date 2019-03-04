<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Touse;
use app\models\Phases;
use app\models\Plants;
use app\models\Problems;
use app\models\Product;
use app\modules\admin\models\PhasesSearch;
use app\modules\admin\models\PlantsSearch;
use app\modules\admin\models\ProblemsSearch;
use app\modules\admin\models\ProductSearch;
use app\modules\admin\models\TouseSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * CountryController implements the CRUD actions for country model.
 */
class CureController extends Controller
{
    /**
     * Lists all country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $problems = ArrayHelper::map(Problems::find()->all(), 'id', 'name');
        $phases = ArrayHelper::map(Phases::find()->all(), 'id', 'name');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');

        return $this->render('index', [
            'product' => $product,
            'phases' => $phases,
            'problems' => $problems,
            'plants' => $plants,
            'searchModel' => $searchModel,
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
        $problems = ArrayHelper::map(Problems::find()->all(), 'id', 'name');
        $phases = ArrayHelper::map(Phases::find()->all(), 'id', 'name');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');		
        return $this->render('view', [
            'model' => $this->findModel($id),
            'product' => $product,
            'phases' => $phases,
            'problems' => $problems,
            'plants' => $plants,            
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionCreate()
    {
        $model = new Touse();
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $problems = ArrayHelper::map(Problems::find()->all(), 'id', 'name');
        $phases = ArrayHelper::map(Phases::find()->all(), 'id', 'name');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');	        

        if ($model->load(Yii::$app->request->post())) {
					
			if ($model->saveForm())
				return $this->redirect(['view', 'id' => $model->id]);
				
        } else {
            return $this->render('create', [
                'model' => $model,
				'product' => $product,
				'phases' => $phases,
				'problems' => $problems,
				'plants' => $plants,                 
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $product = ArrayHelper::map(Product::find()->all(), 'id', 'name_uk');
        $problems = ArrayHelper::map(Problems::find()->all(), 'id', 'name');
        $phases = ArrayHelper::map(Phases::find()->all(), 'id', 'name');
        $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');	

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
				'model' => $model,
				'product' => $product,
				'phases' => $phases,
				'problems' => $problems,
				'plants' => $plants,                       
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Touse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
