<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-26
	 * Time: 00:13
	 */

	namespace app\components\feedManufacture;
	use app\models\Manufacturer;
	use app\models\ProductImage;
	use app\models\Category;
	use Yii;

	class Marketing extends \yii\base\Widget
	{

		public $type_page = '';

		public $item_id = '';

		public $totalValue = '';

		public function init()
		{
			parent::init();
		}

		/**
		 * @return string
		 */
		public function runScript()
		{
			return $this -> getView() -> registerJs(
				'window.dataLayer = window.dataLayer || [];
					dataLayer.push({
						ecomm_itemid: "'.$this -> item_id.'",
						ecomm_pagetype: "'.$this -> type_page.'",
						ecomm_totalvalue: "'.$this -> totalValue.'"
				});
				'
			);
		}
	}
