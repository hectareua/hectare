<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\BonuseForm;
use app\modules\admin\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * HistoryController implements the CRUD actions for HistoryForm model.
 */
class BonusesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HistoryForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $bonuse = new BonuseForm;
        $data = $bonuse->find()->one();
        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Updates an existing HistoryForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save())
                return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the HistoryForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistoryForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BonuseForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
