<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\ProductForm;
use app\models\Category;
use app\models\Manufacturer;
use app\models\Complects;
use app\models\ComplectsProduct;
use app\models\Currency;
use app\models\Image;
use app\models\AttributeOption;
use app\models\Measure;
use app\models\FilterToProduct;
use app\models\Product;
use app\models\Plants;
use app\models\FieldOption;
use app\modules\admin\models\ProductSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for ProductForm model.
 */
class ProductController extends Controller
{

    /**
     * Lists all ProductForm models.
     * @return mixed
     */

    
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductForm model.
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
     * Creates a new ProductForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductForm();
        $model->order = ProductForm::find()->select('max(`order`)')->scalar() + 1;
        $model->is_in_stock = 1;
        $model->updated_at = date('Y-m-d H:j:s');
        $categories = Category::getDropDownList();
        $manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name');
        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
            
            foreach ($model->imagesData as $i=>$_)
                $model->imagesData[$i]['imageFile'] = UploadedFile::getInstanceByName("ProductForm[imagesData][$i][imageFile]");
            if ($model->saveForm())
            {
                if(!empty($model->filters)) {
                    foreach ($model->filters as $filterId) {
                        $productFilter = new FilterToProduct();
                        $productFilter->filter_id = $filterId;
                        $productFilter->product_id = $model->id;
                        $productFilter->save();
                    }
                }

                if ($model->discount) $model->trigger(ProductForm::EVENT_ON_DISCOUNT);
                $model->trigger(ProductForm::EVENT_ON_CREATE);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        return $this->render('create', [
            'model' => $model,
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'currencies' => $currencies,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'attributeOptions' => AttributeOption::getDropDownList(),
            'measuresList'=> Measure::getDropDownList(),
            'measuresListOptions'=> Measure::getDropDownListOptions(),
            'fieldOptions' => FieldOption::getDropDownList(),
            'measure'=> Measure::find()->where(['unit'=> $model->ykazatel])->one(),
        ]);
    }

    /**
     * Updates an existing ProductForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //_d($model->filterFor);
         $model->updated_at = date('Y-m-d H:j:s');
        $categories = Category::getDropDownList();
     /*   $plants1 = Plants::find()->all();
        $plants = array();
        foreach($plants1 as $p) {
			$plants[$p['id']] = $p['name'];
		} */
    //    $plants = ArrayHelper::map(Plants::find()->all(), 'id', 'name');
        $manufacturers = ArrayHelper::map(Manufacturer::find()->all(), 'id', 'name');
        $currencies = ArrayHelper::map(Currency::find()->all(), 'id', 'name');
        $filters = $model->getProductFilters()->all();
        foreach($filters as $filter) {
            $model->filters[] = $filter->id;
        }
             
        if ($model->load(Yii::$app->request->post())) {
            if (empty(Yii::$app->request->post('ProductForm')['attributeValuesData']))
                $model->attributeValuesData = [];
            if (empty(Yii::$app->request->post('ProductForm')['fieldValuesData']))
                $model->fieldValuesData = [];
            foreach ($model->imagesData as $i=>$_)
                $model->imagesData[$i]['imageFile'] = UploadedFile::getInstanceByName("ProductForm[imagesData][$i][imageFile]");
            if ($model->saveForm())
            {
                $oldFilters = [];
                $newFilterIds = [];
                if(!empty($model->filters)) { 
                    foreach ($filters as $filter) {
                        if(!in_array($filter->id, $model->filters)) {
                            $toDelete = FilterToProduct::find()->where(['filter_id' => $filter->id, 'product_id' => $model->id])->one();
                            $toDelete->delete();
                        }
                        $oldFilters[] = $filter->id;
                    }
                    foreach ($model->filters as $filterId) {
                        if(!in_array($filterId, $oldFilters)) {
                            $filter = new FilterToProduct();
                            $filter->filter_id = $filterId;
                            $filter->product_id = $model->id;
                            $filter->save();
                        }
                    }
                } else {
                    foreach ($filters as $filter) {
                        $toDelete = FilterToProduct::find()->where(['filter_id' => $filter->id, 'product_id' => $model->id])->one()->delete();
                    }
                }
                
                
                
                if ($model->discount) $model->trigger(ProductForm::EVENT_ON_DISCOUNT);

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
	/*	$complects = ComplectsProduct::find()->where(['productid' => $model->id])->all();
        $complects = array();
        foreach ($complects as $c) {
			$complects[] = array(
				'id'=>$c['id'],
				'complectid'=>$c['complectid'],
				'productid'=>$c['productid'],
				'attributeid'=>$c['attributeid'],
				'discount'=>$c['discount']
			);
		}
		*/
		$complectsall = ComplectsProduct::find()->where(['productid' => $model->id])->all();
        $complects1 = array();
        $complects = array();
        foreach ($complectsall as $c) {
			$complects1[] = $c['complectid'];
		}
		$complects1 = array_unique($complects1);
        foreach ($complects1 as $c) {
			$pack = ComplectsProduct::find()->where(['complectid' => $c])->all();
			$packproducts = array();
			foreach ($pack as $p) {
				$packproducts[] = array(
					'id'=>$p['id'],
					'complectid'=>$p['complectid'],
				//	'product'=>$_prod[$p['productid']],
					'product'=>$p->product,
				//	'attribute'=>$_attribval[$p['attributeid']],
					'attribute'=>$p->attributeValue,
					'discount'=>$p['discount'],
				);
			}
			$complects[] = array(
				'id'=>$c,
				'products'=>$packproducts
			);			
		}		
        
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories,
            'manufacturers' => $manufacturers,
            'currencies' => $currencies,
            'filters' => $filters,
            'complects' => $complects,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'attributeOptions' => AttributeOption::getDropDownList(),
            'measuresList'=> Measure::getDropDownList(),
            'measuresListOptions'=> Measure::getDropDownListOptions(),
            'fieldOptions' => FieldOption::getDropDownList(),
            'measure'=> Measure::find()->where(['unit'=> $model->ykazatel])->one(),
        ]);
    }

    public function actionSuggest()
    {
        // return $this->renderSuggest();
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        return $this->renderPartial('suggest', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSuggestion_item($id)
    {
        $model = $this->findModel($id);
        $image = $model->getImages()->one();
        return $this->renderPartial('suggestion_item', [
                'model' => $model,
                'image' => $image,
            ]);
    }

    public function actionAlsobuy()
    {
        // return $this->renderAlsobuy();
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        return $this->renderPartial('alsobuy', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAlsobuy_item($id)
    {
        $model = $this->findModel($id);
        $image = $model->getImages()->one();
        return $this->renderPartial('alsobuy_item', [
                'model' => $model,
                'image' => $image,
            ]);
    }

    /**
     * Deletes an existing ProductForm model.
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
     * Finds the ProductForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
