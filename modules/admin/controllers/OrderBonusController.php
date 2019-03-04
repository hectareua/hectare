<?php

namespace app\modules\admin\controllers;

use app\models\Client;
use app\models\ProductBonus;
use Yii;
use app\models\OrderBonus;
use app\modules\admin\models\OrderBonusSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderBonusController implements the CRUD actions for OrderBonus model.
 */
class OrderBonusController extends Controller
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
     * Lists all OrderBonus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderBonusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderBonus model.
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
     * Creates a new OrderBonus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderBonus();
        $user = ArrayHelper::map(Client::find()->all(),
            'user_id',
            function($model) {
            return $model['billing_last_name'].' '.$model['billing_first_name'];
        });
        $product = ArrayHelper::map(ProductBonus::find()->all(),'id','name_uk');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'product' => $product
            ]);
        }
    }

    /**
     * Updates an existing OrderBonus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = ArrayHelper::map(Client::find()->all(),
            'user_id',
            function($model) {
                return $model['billing_last_name'].' '.$model['billing_first_name'];
            });
        $product = ArrayHelper::map(ProductBonus::find()->all(),'id','name_uk');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'user' => $user,
                'product' => $product
            ]);
        }
    }

    /**
     * Deletes an existing OrderBonus model.
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
     * Finds the OrderBonus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrderBonus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrderBonus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
