<?php

namespace app\modules\admin\controllers;

use app\models\AttributeValue;
use app\models\ClientType;
use app\models\ClientTypeBonusAttribute;
use app\models\ClientTypeBonusRel;
use app\models\Manager;
use app\models\Product;
use app\models\User;
use Yii;
use app\models\ClientTypeBonus;
use app\modules\admin\models\ClientTypeBonusSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientTypeBonusController implements the CRUD actions for ClientTypeBonus model.
 */
class ClientTypeBonusController extends Controller
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
     * Lists all ClientTypeBonus models.
     * @return mixed
     */
    public function actionIndex()
    {
        //Yii::$app->cache->flush();
        $searchModel = new ClientTypeBonusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientTypeBonus model.
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
     * Creates a new ClientTypeBonus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ClientTypeBonus();



        if ($model->load(Yii::$app->request->post())) {
            if($model->attrs){
                $maxRel = ClientTypeBonusAttribute::find()->max('rel')+1;

                foreach ($model->attrs as $attribute){

                    $ctypeAttribute = new ClientTypeBonusAttribute();
                    $ctypeAttribute->rel=$maxRel?$maxRel:1;
                    $ctypeAttribute->attribute_value_id=$attribute;
                    $ctypeAttribute->save();
                }
            }
            if($model->bonus_one && !$model->qty_sale) $model->qty_sale = 1000000;
            $model->ctype_bonus_av_rel = $ctypeAttribute->rel;
            $model->save();
            $clientTypeUsers = User::find()->select('id')->where(['ctype' => $model->client_type_id])->all();
            foreach ($clientTypeUsers as $clientTypeUser){
                $managerRel = new ClientTypeBonusRel();
                $managerRel->ctype_bonus_id = $model->id;
                $managerRel->user_id = $clientTypeUser->id;
                $managerRel->save();
            }



            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionProductList($id){
        $countProduct = Product::find()->where(['manufacturer_id' => $id])->andWhere(['status' => 0])->count();
        $products = Product::find()->where(['manufacturer_id' => $id])->andWhere(['product.status' => 0])->orderBy('name_uk')->all();
        if($countProduct > 0){
            echo "<option value>Оберіть товар...</option>";
            foreach ($products as $product){
                foreach ($product->attributeValues as $attributeValue){
                    echo "<option value='{$attributeValue->id}'>{$product->name_uk} ({$attributeValue->option->name})</option>";
                }

            }
        }else{
            echo '<option>Оберіть товар</option>';
        }


    }


    public function actionProductListCheckbox($id){
        $countProduct = Product::find()->where(['manufacturer_id' => $id])->andWhere(['status' => 0])->count();
        $products = Product::find()->where(['manufacturer_id' => $id])->andWhere(['product.status' => 0])->orderBy('name_uk')->all();
        if($countProduct > 0){

            foreach ($products as $product){
                foreach ($product->attributeValues as $attributeValue){

                    echo "<label><input type='checkbox' name='ClientTypeBonus[attrs][]' value='{$attributeValue->id}'>{$product->name_uk} ({$attributeValue->option->name})</label><br />";

                }

            }
        }else{
            echo '<option>Оберіть товар</option>';
        }


    }

    /**
     * Updates an existing ClientTypeBonus model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         // Yii::$app->cache->flush();
        $model = $this->findModel($id);

        $attributes = ClientTypeBonusAttribute::find()->select('attribute_value_id')->where(['rel' => $model->ctype_bonus_av_rel])->asArray()->all();
        $arrAttributes = array();
        foreach ($attributes as $attribute){
            array_push($arrAttributes,$attribute['attribute_value_id']);
        }
        $modelOld = clone $model;

        if ($model->load(Yii::$app->request->post())) {
             if($model->bonus_one && !$model->qty_sale) $model->qty_sale = 1000000;
             if($model->attrs && !$model->attribute_value_id){
                 if(!$modelOld->ctype_bonus_av_rel){
                     $maxRel = ClientTypeBonusAttribute::find()->max('rel')+1;
                     $model->ctype_bonus_av_rel = $maxRel;
                 }

                ClientTypeBonusAttribute::deleteAll(['rel'=>$model->ctype_bonus_av_rel]);
                foreach ($model->attrs as $attribute){
                    $ctypeAttribute = new ClientTypeBonusAttribute();
                    $ctypeAttribute->rel=$modelOld->ctype_bonus_av_rel?$modelOld->ctype_bonus_av_rel:$maxRel;
                    $ctypeAttribute->attribute_value_id=$attribute;
                    $ctypeAttribute->save();
                }
            }else{
                 ClientTypeBonusAttribute::deleteAll(['rel'=>$model->ctype_bonus_av_rel]);
                 $model->ctype_bonus_av_rel = NULL;
             }
            if($modelOld->client_type_id == $model->client_type_id){
                 /*start insert clients who has the same type bonus*/
                $countClientsBonus = ClientTypeBonusRel::find()->select('user_id')->distinct()
                    ->joinWith('user')
                    ->where(['user.ctype'=>$model->client_type_id])
                    ->andWhere(['ctype_bonus_id' => $model->id])->all();
                $idsClientHaveBonus = ArrayHelper::getColumn($countClientsBonus, 'user_id');
                $countTypeUsers = User::find()->select('id')->where(['ctype' => $model->client_type_id])->all();
                if(count($countClientsBonus) < count($countTypeUsers)){
                    $addUsers = User::find()->select('id')->where(['and',['ctype' => $model->client_type_id],['not in', 'id', $idsClientHaveBonus]])->all();
                    if(is_array($addUsers)){
                        foreach ($addUsers as $addUser){
                            $managerRel = new ClientTypeBonusRel();
                            $managerRel->ctype_bonus_id = $model->id;
                            $managerRel->user_id = $addUser->id;
                            $managerRel->save();
                        }
                    }
                }
                /*end*/
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                ClientTypeBonusRel::deleteAll(['ctype_bonus_id'=>$modelOld->id]);
                $clientTypeUsers = User::find()->select('id')->where(['ctype' => $model->client_type_id])->all();
                foreach ($clientTypeUsers as $clientTypeUser){
                    $managerRel = new ClientTypeBonusRel();
                    $managerRel->ctype_bonus_id = $model->id;
                    $managerRel->user_id = $clientTypeUser->id;
                    $managerRel->save();
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {
            return $this->render('update', [
                'model' => $model,
                'arrAttributes' => $arrAttributes
            ]);
        }
    }

    /**
     * Deletes an existing ClientTypeBonus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        ClientTypeBonusRel::deleteAll(['ctype_bonus_id'=>$id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClientTypeBonus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientTypeBonus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientTypeBonus::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
