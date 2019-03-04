<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Order;
use app\models\OrderStatus;
use app\models\Product;
use app\modules\admin\models\OrderSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        foreach($this->findModel($id)->orderProducts as $orderProduct)
        {
            $products[] = Product::findOne($orderProduct->product_id);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'products' => $products,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_ttn = $model->ttn;
        $statuses = ArrayHelper::map(OrderStatus::find()->all(), 'id', 'name_uk');
        $oldStatusId = $model->status_id;
        $pp = Yii::$app->get('pp');
        if ($model->load(Yii::$app->request->post()) ) {

            if($model->status_id == ORDER::PAYPARTS_CONFIRMED || $model->status_id == ORDER::PAYPARTS_REJECTED) {
                if ($oldStatusId == ORDER::PAYPARTS_NOT_CONFIRMED) {

                    $orderId = "ORDER-".$model->id;

                    if ($model->status_id == ORDER::PAYPARTS_CONFIRMED) {
                        $hold = $pp->ConfirmHold($orderId);
                    } else {
                        $hold=$pp->CancelHold($orderId);
                    }

                    if ($hold == 'error') {
                        $model->setAttribute('status_id', $oldStatusId);
                    }
                } else {
                    $model->setAttribute('status_id', $oldStatusId);
                }
            }

            if ($model->status_id == ORDER::PAYPARTS_NOT_CONFIRMED && $oldStatusId == ORDER::NEW_ORDER) {

                    $orderId = "ORDER"."-".$id;
                    $getState = $pp->getState($orderId, false);

                    if ($getState !== 'error') {
                        if ($getState['paymentState'] !== 'LOCKED' || $getState['state'] !== 'SUCCESS') {
                            $model->setAttribute('status_id', $oldStatusId);
                        }
                    }

            } elseif ($model->status_id == ORDER::PAYPARTS_NOT_CONFIRMED) {
                $model->setAttribute('status_id', $oldStatusId);
            }

            if ($oldStatusId == ORDER::PAYPARTS_CONFIRMED || $oldStatusId == ORDER::PAYPARTS_REJECTED) {
                $model->setAttribute('status_id', $oldStatusId);
            }

            if($model->save()) {

                if ($model->ttn != $old_ttn)
                    $model->trigger(Order::EVENT_ON_TTN);
                
                if ($model->status_id != $oldStatusId)
                    $model->trigger(Order::EVENT_UPDATE_STATUS);    
                    
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }else {
            return $this->render('update', [
                    'model' => $model,
                    'statuses' => $statuses,
                ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
