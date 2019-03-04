<?php

namespace app\modules\api\controllers;

use app\models\Manufacturer;
use app\models\Category;
use yii\data\ActiveDataProvider;

class ManufacturersController extends ApiController
{
    public function actionIndex($category_id = null)
    {
    	$category = Category::findOne($category_id);
    	$category_ids = [];
    	$category_ids[] = $category->id;
    	foreach ($category->categories as $subCategory)
    		$category_ids[] = $subCategory->id;

        return new ActiveDataProvider([
            'query' => Manufacturer::find()
    			->select(['manufacturer.id', 'manufacturer.name'])
            	->joinWith('products')
            	->where(['product.category_id' => $category_ids])->distinct(),
        ]);
    }
}