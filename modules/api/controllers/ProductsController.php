<?php

namespace app\modules\api\controllers;

use app\models\Category;
use app\models\Product;
use app\models\User;
use app\models\Manufacturer;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;

class ProductsController extends ApiController
{
    private function useProductSerializer()
    {
      $this->serializer = [
        'class' => 'app\modules\api\components\ProductSerializer'
      ];
    }

    public function actionView($id)
    {
      $this->useProductSerializer();
    	return Product::findOne($id);
    }

    public function actionViewProducts(array $ids)
    {
       $this->useProductSerializer();
        return new ActiveDataProvider([
            'pagination' => [
                'pageSize' => 20,
            ],
            'query' => Product::find()->where(['IN','id',$ids])
        ]);
    }
    public function actionSale($manufacturer_id=null)
    {
        // return new ActiveDataProvider([
        //     'pagination' => false,
        //     'query' => Product::find()
        //         ->where(['is_on_sale' => true]),
        // ]);

        // select * from product LEFT JOIN Manufacturer M on product.manufacturer_id = M.id where discount=1 or is_sale=1;
        // забрать товары с акцией и товары производителей с акцией
        $models = Product::find()->select('product.*')->leftJoin('manufacturer',
            '`manufacturer`.`id` = `product`.`manufacturer_id`')
            ->where(['!=','manufacturer.discount',''])->orWhere(['is_on_sale'=>1]);
            
        $models->with(['reviews' => function($query) {
            $query->andWhere(['is_visible' => 1]);
        }]);
        
        if($manufacturer_id){
            $models->andWhere(['manufacturer_id' => $manufacturer_id]);
        }
        
        // get product manufacturers
        $manufacturers = $this->salesManufacturer($models);
        // get product categories
        $categories = $this->salesCategories($models);
        $pager = ['totalCount' => $models->count(), 'pageSize' => 16, 'defaultPageSize' => 16];
        $pagination = new Pagination($pager);

        $numberPages = $pagination->getPageCount();
        if($numberPages ==  0) {
            $numberPages = 1;
        }
        $page = \Yii::$app->request->get('page', 1);
        $models = $models->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy('order asc') //->orderBy('super desc,topsale desc,order asc')
            ->with(['reviews' => function($query) { $query->andWhere(['is_visible' => 1]);}])
            ->all();

        return ["page"=>['totalCount'=>$pager] ,"filters"=>$manufacturers, "categories"=>$categories, "products"=>$models];

    }
  
    public function actionSearch($search, $page, $items)
    {
        $this->serializer['fields'] = ['id', 'name_uk', 'name_ru', 'manufacturer_name', 'currencyPrice', 'ykazatel', 'currencyPriceForAttribute', 'rating'];
        $this->serializer['expand'] = ['image','fieldOptionIds', 'attributeOptionIds', 'attributeValues'];
        $paginationParams = ['page' => $page, 'pageSize' => $items];
        return new ActiveDataProvider([
            'pagination' => $paginationParams,
            'query' => Product::find()->where([
                'or',
                ['like', 'name_uk', $search],
                ['like', 'name_ru', $search],
                ['like', 'dv', $search]
            ])
        ]);
    }

    private function salesManufacturer($items) {

        $productManufacturers = clone $items;
        $productManufacturers = $productManufacturers
            ->select(['manufacturer_id', 'COUNT(1) as cnt'])
            ->groupBy(['manufacturer_id'])
            ->asArray()
            ->all();

        $_manufacturers = Manufacturer::find()->where(['id' => array_column($productManufacturers, 'manufacturer_id')])->all();

        $manufacturers = null;
        // generate manufacturers list
        foreach ($_manufacturers as $manufacturer) {
            $manufacturers[$manufacturer->id] = ['manufacturer' => $manufacturer, 'checked' => false];
        }
        // count manufacturers elements
        foreach ($productManufacturers as $productManufacturer) {
            if($productManufacturer['manufacturer_id']) {
                $manufacturers[$productManufacturer['manufacturer_id']]['count'] = (int)$productManufacturer['cnt'];
            }
        }

        return $manufacturers;
    }
    private function salesCategories($items) {
        $productCategories = clone $items;
        $productCategories = $productCategories
            ->select(['category_id', 'COUNT(1) as cnt'])
            ->groupBy(['category_id'])
            ->asArray()
            ->all();

        $_categories = Category::find()->where(['id' => array_column($productCategories, 'category_id')])->all();

        $categories = null;
        // generate manufacturers list
        foreach ($_categories as $category) {
            $categories[$category->id] = ['category' => $category, 'checked' => false];
        }
        // count manufacturers elements
        foreach ($productCategories as $productCategory) {
            if($productCategory['category_id']) {
                $categories[$productCategory['category_id']]['count'] = (int)$productCategory['cnt'];
            }
        }

        return $categories;
    }
}