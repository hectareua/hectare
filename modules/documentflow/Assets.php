<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-22
	 * Time: 20:30
	 */

	namespace app\modules\documentflow;
	use yii\web\AssetBundle;
	use yii\web\View;

	class Assets extends AssetBundle
	{
		public $sourcePath = '@documentflow-assets';

		public $js = [
//			['js/document.js','position' => View::POS_END],
		];

		public $css = [
			'css/document.css',
		];
	}