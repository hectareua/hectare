<?php

namespace app\modules\admin\controllers;

use app\models\InfoPdfImages;
use app\models\InfoTabs;
use app\models\InfoTabsContent;
use app\models\UploadPdfForm;
use app\modules\admin\models\InfoTabsContentForm;
use Yii;
use app\modules\admin\controllers\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

/**
 * HistoryController implements the CRUD actions for HistoryForm model.
 */
class InfoTabsContentController extends Controller
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
        $dataProvider = new ActiveDataProvider(['query' => InfoTabsContentForm::find()]);
        $dataProviderImg = new ActiveDataProvider(['query' => InfoPdfImages::find()]);


        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'dataProviderImg' => $dataProviderImg,
        ]);
    }

    /**
     * Displays a single HistoryForm model.
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
     * Creates a new HistoryForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InfoTabsContentForm();
        $infoTabs = ArrayHelper::map(InfoTabs::find()->all(), 'id', 'name_uk');
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->imageFileTwo = UploadedFile::getInstance($model, 'imageFileTwo');
            foreach ($model->imagesData as $i=>$_)
                $model->imagesData[$i]['imageFile'] = UploadedFile::getInstanceByName("InfoTabsContentForm[imagesData][$i][imageFile]");
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            if(empty($model->pdf_url) && !empty($model->pdfFile)){
                $model->pdf_url = 'pdf/' . $model->pdfFile->baseName . '.' . $model->pdfFile->extension;
            }
                // file is uploaded successfully

            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'infoTabs' => $infoTabs,
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
        $infoTabs = ArrayHelper::map(InfoTabs::find()->all(), 'id', 'name_uk');
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->imageFileTwo = UploadedFile::getInstance($model, 'imageFileTwo');
            foreach ($model->imagesData as $i=>$_)
                $model->imagesData[$i]['imageFile'] = UploadedFile::getInstanceByName("InfoTabsContentForm[imagesData][$i][imageFile]");
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            if(empty($model->pdf_url) && !empty($model->pdfFile)){
                $model->pdf_url = 'pdf/' . $model->pdfFile->baseName . '.' . $model->pdfFile->extension;
            }
            // file is uploaded successfully

            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'infoTabs' => $infoTabs,
        ]);
    }

    /**
     * Deletes an existing HistoryForm model.
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
     * Finds the HistoryForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HistoryForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InfoTabsContentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
