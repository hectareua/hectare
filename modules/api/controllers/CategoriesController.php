<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\Category;
use app\models\Product;
use yii\data\ActiveDataProvider;

class CategoriesController extends ApiController
{
    public function actionIndex()
    {
      return new ActiveDataProvider([
            'query' => Category::find()
            	->where(['parent_id' => null])
            	->orderBy(['order'=>'asc']),
        ]);
    }

    public function actionListUpdated($timestamp)
    {
        return Category::findUpdated($timestamp)->asArray()->all();
    }

    public function actionItems($id, $page, $items)
    {
      $this->setSearchSerializer();
      $paginationParams = ['page' => $page, 'pageSize' => $items];
      return new ActiveDataProvider([
          'pagination' => $paginationParams,
          'query' => Product::find()
                      ->where(['=', 'category_id', $id]),
          'sort'=> ['defaultOrder' => ['order'=>SORT_ASC,'name_uk'=>SORT_DESC]]
      ]);
    }

    public function actionItemsSearch($search, $id, $page, $items)
    {
      $this->setSearchSerializer();
      $paginationParams = ['page' => $page, 'pageSize' => $items];
      return new ActiveDataProvider([
          'pagination' => $paginationParams,
          'query' => Product::find()
                      ->where(['and',
                                ['=', 'category_id', $id],
                                ['or',
                                  ['like', 'name_uk', $search],
                                  ['like', 'name_ru', $search],
                                  ['like', 'dv', $search]
                                ]
                              ])
                      ->orderBy('name_uk')
      ]);
    }

    private function setSearchSerializer() {
$this->serializer['fields'] = ['id', 'category_id', 'name_uk', 'name_ru', 'manufacturer',
            'images', 'opt', 'dv', 'dv_uk', 'opt_uk', 'opt1', 'opt_uk1', 'currencyPrice','currencyPriceForAttribute',
            'updated_at', 'ykazatel', 'currencyOldPrice', 'is_in_stock', 'is_new',  'norms', 'rating'];
        $this->serializer['expand'] = ['suggestedProducts','alsobuyProducts', 'manufacturerId', 'description_uk', 'description_ru', 'reviews', 'fieldOptionIds', 'attributeOptionIds', 'attributeValues'];
    }
}
