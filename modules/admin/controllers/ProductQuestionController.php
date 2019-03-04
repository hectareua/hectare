<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductQuestion;
use app\modules\admin\models\ProductQuestionSearch;
use yii\web\NotFoundHttpException;

/**
 * ProductQuestionController implements the CRUD actions for ProductQuestion model.
 */
class ProductQuestionController extends Controller
{

    /**
     * Lists all ProductQuestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductQuestion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // public function actionDeletequestions($start_id, $end_id)
    // {
    //     $reviews = ProductQuestion::find()->where('id>='.$start_id)->andWhere('id<='.$end_id)->all();
    //     foreach($reviews as $review)
    //     {
    //         $review->delete();
    //     }
    // }
    

    /**
     * Deletes an existing ProductQuestion model.
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
     * Finds the ProductQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
