<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Complects;
use app\modules\admin\models\ComplectsSearch;
use app\modules\admin\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * ComplectsController implements the CRUD actions for model.
 */
class ComplectsController extends Controller
{
    /**
     * Lists all country models.
     * @return mixed
     */
    public function actionIndex()
    { 
		$searchModel = new ComplectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionCreate()
    {
        $model = new Complects();    

        if ($model->load(Yii::$app->request->post())) {
			if ($model->saveForm()) {
				return 'Створено!';
			}
        } else {
            return $this->render('create', [
                'model' => $model,    
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
				'model' => $model, 
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Complects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
