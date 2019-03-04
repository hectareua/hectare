<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\CategoryForm;
use app\modules\admin\models\CategorySearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for CategoryForm model.
 */
class CategoryController extends Controller
{

    /**
     * Lists all CategoryForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CategoryForm model.
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
     * Creates a new CategoryForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CategoryForm();
        $parents = CategoryForm::getDropDownList();
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->parent_id)
                $model->parent_id = null;
            $last_order_model = CategoryForm::find()->where(['parent_id'=>$model->parent_id])->orderBy(['order' => SORT_DESC])->one();
            if ($last_order_model == null) {
                $model->order = 1;
            } else {
                $model->order = $last_order_model->order + 1;
            }
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'parents' => $parents,
            ]);
        }
    }

    /**
     * Updates an existing CategoryForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $parents = CategoryForm::getDropDownList($id);
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->parent_id)
                $model->parent_id = null;
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->saveForm())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'parents' => $parents,
            ]);
        }
    }

    /**
     * Deletes an existing CategoryForm model.
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
     * Finds the CategoryForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CategoryForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CategoryForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
