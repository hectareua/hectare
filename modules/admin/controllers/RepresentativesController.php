<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Representative;
use yii\data\ActiveDataProvider;
//use app\modules\admin\controllers\Controller;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\admin\models\RepresentativeForm;
use app\modules\admin\models\RepresentativeSearch;

/**
 * RepresentativesController implements the CRUD actions for Representative model.
 */
class RepresentativesController extends Controller
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
     * Lists all Representative models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Representative::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]); 
 /*       $searchModel = new RepresentativeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);    */    
    }

    /**
     * Displays a single Representative model.
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
     * Creates a new Representative model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RepresentativeForm();

  //      if ($model->load(Yii::$app->request->post()) && $model->save()) {
          if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');


            if ($model->saveForm())
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Representative model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post())) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
			
			if (!($model->validate())) {
/*
				if (!(!empty($model->image_id) && $model->image_id !== 0)) {
					$model->image_id =  1200000;
				}
					*/
					
				if (!(!empty($model->imageFile) && $model->imageFile->size !== 0)) {
					$model->image_id =  NULL;
				}
			}
            if ($model->saveForm()) {
				return $this->redirect(['view', 'id' => $model->id]);
			} else {var_dump($model->image_id);
				var_dump($model->errors);
			}
        } else {
            return $this->render('update', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing Representative model.
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
     * Finds the Representative model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Representative the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
 /*   protected function findModel($id)
    {
        if (($model = Representative::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } */
    protected function findModel($id)
    {
        if (($model = RepresentativeForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    
}
