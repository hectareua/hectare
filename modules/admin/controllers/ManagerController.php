<?php

namespace app\modules\admin\controllers;

use app\models\Manager;
use Yii;
use app\modules\admin\models\ManagerForm;
use app\modules\admin\models\ManagerSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ManagerFormController implements the CRUD actions for ManagerForm model.
 */
class ManagerController extends Controller
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
     * Lists all ManagerForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManagerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ManagerForm model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $manager = $this->findModel($id);
        $headOfManager = Manager::find()->select('name')->where(['id' => $manager->user_add_id])->scalar();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'headOfManager' => $headOfManager,
        ]);
    }

    /**
     * Creates a new ManagerForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ManagerForm();
        $headOfManager = ArrayHelper::map(Manager::find()->where(['!=','manager_type',3])->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->imageFileTwo = UploadedFile::getInstance($model, 'imageFileTwo');


            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'headOfManager' => $headOfManager,
            ]);
        }
    }

    /**
     * Updates an existing ManagerForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $headOfManager = ArrayHelper::map(Manager::find()->where(['!=','manager_type',3])->all(), 'id', 'name');
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->imageFileTwo = UploadedFile::getInstance($model, 'imageFileTwo');

            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'headOfManager' => $headOfManager,
            ]);
        }
    }

    /**
     * Deletes an existing ManagerForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      if(ManagerForm::find()->count() > 1)
      {
        $this->findModel($id)->delete();
      }else
      {
        \Yii::$app->session->setFlash('error', 'Не можна видалити всiх менеджерiв');
      }

        return $this->redirect(['index']);
    }

    /**
     * Finds the ManagerForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManagerForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManagerForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
