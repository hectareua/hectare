<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\SlideForm;
use app\modules\admin\controllers\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * SlideFormrController implements the CRUD actions for SlideForm model.
 */
class SliderController extends Controller
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
     * Lists all SlideForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => SlideForm::find()]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SlideForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SlideForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SlideForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFileRu = UploadedFile::getInstance($model, 'imageFileRu');
            $model->imageFileUk = UploadedFile::getInstance($model, 'imageFileUk');
			$model->imageFileDeskRu = UploadedFile::getInstance($model, 'imageFileDeskRu');
            $model->imageFileDeskUk = UploadedFile::getInstance($model, 'imageFileDeskUk');
            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SlideForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFileRu = UploadedFile::getInstance($model, 'imageFileRu');
            $model->imageFileUk = UploadedFile::getInstance($model, 'imageFileUk');
			$model->imageFileDeskRu = UploadedFile::getInstance($model, 'imageFileDeskRu');
            $model->imageFileDeskUk = UploadedFile::getInstance($model, 'imageFileDeskUk');
            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SlideForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SlideForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SlideForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SlideForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
