<?php

namespace app\modules\api\components;

class ProductSerializer extends \yii\rest\Serializer
{
  private $expand = ['suggestedProducts','alsobuyProducts', 'manufacturerId', 'description_uk', 'description_ru', 'reviews', 'fieldOptionIds', 'attributeOptionIds', 'attributeValues'];
  private $fields = ['id', 'category_id', 'name_uk', 'name_ru', 'manufacturer',
  'images', 'opt', 'dv', 'dv_uk', 'opt_uk', 'opt1', 'opt_uk1', 'currencyPrice','currencyPriceForAttribute',
  'updated_at', 'ykazatel', 'currencyOldPrice', 'is_in_stock', 'is_new',  'norms', 'rating'];

	public function getRequestedFields()
	{
		return [$this->fields, $this->expand];
	}
}
