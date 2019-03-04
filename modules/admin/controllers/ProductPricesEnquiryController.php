<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductPricesEnquiry;
use app\modules\admin\models\ProductPricesEnquirySearch;
use yii\web\NotFoundHttpException;

/**
 * ProductPricesEnquiryController implements the CRUD actions for ProductPricesEnquiry model.
 */
class ProductPricesEnquiryController extends Controller
{

    /**
     * Lists all ProductPricesEnquiry models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductPricesEnquirySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductPricesEnquiry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // public function actionDeletepricesenquiries($start_id, $end_id)
    // {
    //     $reviews = ProductPricesEnquiry::find()->where('id>='.$start_id)->andWhere('id<='.$end_id)->all();
    //     foreach($reviews as $review)
    //     {
    //         $review->delete();
    //     }
    // }
    
    /**
     * Deletes an existing ProductPricesEnquiry model.
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
     * Finds the ProductPricesEnquiry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductPricesEnquiry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductPricesEnquiry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
