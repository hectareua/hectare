<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-26
	 * Time: 00:13
	 */

	namespace app\components\DimanycMarcetingScript;
	use app\models\Manufacturer;
	use app\models\ProductImage;
	use app\models\Category;
	use Yii;

	class Marketing extends \yii\base\Widget
	{

		public function init()
		{
			parent::init();
		}

		/**
		 * @return string
		 */
		public function runScript($item_id,$type_page,$totalValue)
		{
			return $this -> getView() -> registerJs(
				'window.dataLayer = window.dataLayer || [];
					dataLayer.push({
						ecomm_itemid: "'.$item_id.'",
						ecomm_pagetype: "'.$type_page.'",
						ecomm_totalvalue: "'.$totalValue.'"
				});
				'
			);
		}
	}
