<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\CallRequest;
use app\modules\admin\models\CallRequestSearch;
use yii\web\NotFoundHttpException;

/**
 * CallRequestController implements the CRUD actions for CallRequest model.
 */
class CallRequestController extends Controller
{

    /**
     * Lists all CallRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CallRequest model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // public function actionDeletecallrequests($start_id, $end_id)
    // {
    //     $reviews = CallRequest::find()->where('id>='.$start_id)->andWhere('id<='.$end_id)->all();
    //     foreach($reviews as $review)
    //     {
    //         $review->delete();
    //     }
    // }
    

    /**
     * Deletes an existing CallRequest model.
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
     * Finds the CallRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CallRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CallRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
