<?php

namespace app\modules\api\controllers;
use app\models\Category;
use app\models\Filter;
use app\models\Manufacturer;
use Yii;
use app\models\Product;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\data\Pagination;


class FilterController extends ApiController
{
	public function actionIndex()
    {
        $categories = new Category();
        $cats_items = $categories->find()->where(['parent_id'=>1])->all();
        $combineCategories = ['name_ru'=>'Каталог товаров','name_uk'=>'Каталог товарів', 'list'=>$cats_items];

        $manufactures = new Manufacturer();
        $manItems = $manufactures->find();
        $filterList = [
            'Каталог товаров' => $combineCategories,
            'Производители' => '',
            'Для защиты от' => '',
            'Культура' => '',
            'Болезни' => '',
            'по объекту применения' => ''

        ];

        return $filterList;
    }


    public function actionList($category_slug, $manufacturer_ids = "",$filter_ids="")
    {

        $categories = new Category();

        $manufacturer_ids = array_filter(explode(",", $manufacturer_ids), function($i){return !!$i;});
        $category = Category::findOne(['slug' => $category_slug]);
        if (!$category)
            $category = Category::findOne($category_slug);
        if (!$category) {
            throw new \yii\web\NotFoundHttpException();
        }
        $cats_items = $categories->find()->where(['parent_id'=>$category->id])->all();
        if (!$cats_items){
            $cats_items = $categories->find()->where(['parent_id'=>$category->parent_id])->all();
        }

        foreach ($cats_items as $index=>$cats_item){

            if(count($cats_item->categories) < 1 && count($cats_item->products) < 1){
                array_splice($cats_items, $index, 1);
            }
        }

        $models = $category->categories;
        $parents = [];
        $parent = $category;
        while ($parent = $parent->parent)
            array_unshift($parents, $parent);


        $parentFilters = Filter::find()->where(['filter_id' => null])->with(['filters', 'filters.products' => function($query) use ($category, $manufacturer_ids) {
            $query->andWhere(['category_id' => $category->id]);
            if ($manufacturer_ids) {
                $query->andWhere(['manufacturer_id' => $manufacturer_ids]);
            }
        }])->all();



        $models = $category->getProducts();
        $productManufacturers = clone $models;
        $productManufacturers = $productManufacturers
            ->select(['manufacturer_id', 'COUNT(1) as cnt'])
            ->groupBy(['manufacturer_id'])
            ->asArray()
            ->all();

        if ($manufacturer_ids)
            $models->where(['manufacturer_id' => $manufacturer_ids]);
        if(strlen($filter_ids) > 0)
        {
            $filter_ids = array_filter(explode(",", $filter_ids), function($i){return (bool)$i;});
            $items = Filter::find()->where(['id' => $filter_ids])->with(['filterToProducts'])->asArray()->all();
            $items = ArrayHelper::getColumn($items, 'filterToProducts');
            $ids = [];
            foreach ($items as $item) {
                foreach($item as $itemOne) {
                    $ids[] = $itemOne['product_id'];
                }
            }
            // добавляем к модели условие на выборку
            $models->andWhere(['id' => $ids]);
        } else {
            $filter_ids = [];
        }

        $_manufacturers = Manufacturer::find()->where(['id' => array_column($productManufacturers, 'manufacturer_id')])->all();
        foreach ($_manufacturers as $manufacturer)
            $manufacturers[$manufacturer->id] = ['manufacturer' => $manufacturer, 'checked' => false];
        foreach ($productManufacturers as $productManufacturer)
            if ($productManufacturer['manufacturer_id'])
                $manufacturers[$productManufacturer['manufacturer_id']]['count'] = $productManufacturer['cnt'];
        if ($manufacturer_ids) {
            foreach ($manufacturer_ids as $manufacturer_id)
                if (isset($manufacturers[$manufacturer_id])) {
                    $manufacturers[$manufacturer_id]['checked'] = true;
                } else {
                    throw new \yii\web\NotFoundHttpException();
                }
        }


        $pageFilters = ['Каталог товарів' => $cats_items, 'Виробники'=>$manufacturers];
        $parentFilters = ArrayHelper::index($parentFilters, 'id');
        foreach ($parentFilters as $key => $parentFilter ) {
            foreach ($parentFilter->filters as $childFilter) {
                if(count($childFilter->products) > 0)
                    $pageFilters[$parentFilter->name][$childFilter->id] = [
                        'filter' => $childFilter,
                        'count' => count($childFilter->products),
                        'checked' => false,
                    ];
            }
        }

        $count = $models->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 16, 'defaultPageSize' => 16]);


        $label_topsale = Yii::$app->language == 'uk' ? 'Топ продаж':'Топ продаж';
        $label_price = Yii::$app->language == 'uk' ? 'По ціні':'По цене';
        $label_order = Yii::$app->language == 'uk' ? 'По рейтингу':'По рейтингу';
        $label_super = Yii::$app->language == 'uk' ? 'Краща ціна':'Лучшая цена';
        $label_sale = Yii::$app->language == 'uk' ? 'Акційні':'Акционные';

        $sort = new Sort([
            'attributes' => [
                'topsale' => [
                    'asc' => ['topsale' => SORT_ASC],
                    'desc' => ['topsale' => SORT_DESC],
                    'label' => $label_topsale,
                ],
                'price' => [
                    'desc' => ['price' => SORT_DESC],
                    'asc' => ['price' => SORT_ASC],
                    'label' => $label_price,
                ],
                'order' => [

                    'asc' => ['cont' => SORT_DESC],
                    'desc' => ['cont' => SORT_DESC],
                    'default' => ['cont' => SORT_DESC],
                    'label' => $label_order,

                ],
                'super' => [
                    'asc' => ['super' => SORT_ASC],
                    'desc' => ['super' => SORT_DESC],
                    'label' => $label_super
                ],
                'sale' => [
                    'asc' => ['is_on_sale' => SORT_ASC],
                    'desc' => ['is_on_sale' => SORT_DESC],
                    'label' => $label_sale
                ]
            ],
        ]);
        $sortBy = array();
        if (empty($sort->orders)){
            $sortBy['order'] = SORT_ASC;
        }else{
            $sortBy = $sort->orders;
        }

        $subQuery=Product::find()
            ->select([ "COUNT(*) as cont","product.id as prod_id"])
            ->join('LEFT JOIN','review', 'product.id = review.product_id')
            ->where(['is_visible' => 1])
            ->groupBy("product.id");


        $models = $models->orderBy($sortBy)
            ->select(["T.cont as cont","product.*"])
            ->leftJoin(['T' => $subQuery], 'T.prod_id = product.id')
            ->limit($pagination->limit)
            ->offset($pagination->offset)
            ->all();


        return ['filters'=>$pageFilters, 'products'=>$models];
    }


}
