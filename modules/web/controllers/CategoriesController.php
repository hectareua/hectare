<?php
namespace app\modules\web\controllers;

use app\components\FilterCure\Filter;
use Yii;
use app\models\Category;
use app\models\Product;
use app\models\ProductImage;
use app\models\Manufacturer;
use app\models\Currency;
use app\models\Plants;
use app\models\Phases;
use app\models\Problems;
use app\models\Touse;
use app\models\Image;
use yii\helpers\ArrayHelper;

class CategoriesController extends Controller
{

      public function behaviors(){
        return [
            [
                'class' => 'yii\filters\HttpCache',
                'only' => ['index','subcategory'],
                'lastModified' => function ($action, $params) {
                        if ($this->action->id == 'index') {
                            $q = new \yii\db\Query();
                            return strtotime($q->from('product')->max('updated_at'));
                        }
                        else{
                        
                       $q = new \yii\db\Query();

                              return strtotime($q->from('product')->where(['category_id'=>Yii::$app->request->get('category_id')])->max('updated_at'));
                          
                             
                        }
                   
                },
    //            'etagSeed' => function ($action, $params) {
    //                return // generate etag seed here
    //            }
            ],
        ];
    }

    
    public function beforeAction($action) {
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;
        
        return parent::beforeAction($action);
    }
    
    public function actionIndex()
    {
        $saleProducts = $this->_loadSaleProductsModels();
        $models = Category::find()
            ->where(['parent_id' => null])
            ->orderBy('order')
            ->all();
        return $this->render('index', compact('models', 'saleProducts'));
    }

    public function actionSubcategory($category_id)
    {
        $category = Category::findOne(['slug' => $category_id]);
        if (!$category)
            $category = Category::findOne($category_id);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException();
        }
        $models = $category->categories;
        $parents = [];
        $parent = $category;
        while ($parent = $parent->parent)
            array_unshift($parents, $parent);
        return $this->render('subcategory', compact('models', 'category', 'parents'));
    }
    
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new \yii\web\NotFoundHttpException();
        }
    }
    public function actionBrand($brand_id)
    {

      //   $saleProducts = $this->_loadSaleProductsModels();
       $manufacturer = Manufacturer::findOne(['slug' => $brand_id]);
       $models = Product::find()
			->select('product.*,pi.*,product.id as id')
			->leftJoin('product_image pi', '`pi`.`product_id` = `product`.`id`')
			->where(['product.manufacturer_id' => $manufacturer->id])
            ->orderBy('product.name_ru')
            ->all();

     //   $category = Category::findOne($category_id);
    
		$currency = Currency::find()->all();
		$cur = array();
		foreach ($currency as $c) {
			$cur[$c['id']] = $c;
		}
		$currency = $cur;     
     
        
        $categories = Category::find()->joinWith(['products'], true, 'INNER JOIN')->where(['manufacturer_id' => $manufacturer->id])->asArray()->all();
        
        $manufacturers = Manufacturer::find()->orderBy('name')->all();


        return $this->render('brand', compact('currency','models', 'categories' ,'manufacturer'));

    }
    
    
    public function actionBrands()
    {
        $manufacturers = Manufacturer::find()->orderBy('name')->all();
        return $this->render('brands', compact('manufacturers'));
    }

	/**
	 * @param int $cure_id
	 *
	 * @return string
	 */
    public function actionCure($cure_id=0)
    {
        $products = Product::find()->orderBy('name_ru') -> select('id,name_uk,name_ru,id,category_id') -> with('category') -> all();
        $plants = Plants::find()->orderBy('name')->all();
        $images = Image::find()->orderBy('id')->all();
        $phases = Phases::find()->orderBy('name')->all();
        $problems = Problems::find()->orderBy('name')->all();
        $touse = Touse::find()->orderBy('plant_id')->all();
		$currency = Currency::find()->all();

		$cur = array();
		foreach ($currency as $c) {
			$cur[$c['id']] = $c;
		}
		$currency = $cur;

		$manufacture = '';
		$get = Yii::$app -> request -> get();
		if(!empty($get)) {
			if($get['cure_id'] == 0) {
				$id = $get['manufacturer_id_filter'];
				$manufacture = Manufacturer::findOne($id);
				$cure = Touse::forFilterData($get['cure_id'],$id);
			} else {
				$cure_id = 1;
				if(isset($get['manufacturer_id_filter'])) {
					$manufacture = Manufacturer::findOne($get['manufacturer_id_filter']);
					$cure = Touse::forFilterData($get['cure_id'],$get['manufacturer_id_filter']);
				} else {
					$cure = Touse::forFilterData($get['cure_id'],1);
				}
			}
		} else {
			$cure = Touse::forFilterData($cure_id);
		}

        return $this->render('cure', compact('plants','currency','products','phases','problems','touse','cure','cure_id','images','manufacturer_select','manufacture'));
    }
}
