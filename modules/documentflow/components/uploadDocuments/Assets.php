<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-22
	 * Time: 20:30
	 */
	namespace app\modules\documentflow\components\uploadDocuments;

	use yii\web\AssetBundle;
	use yii\web\View;

	class Assets extends AssetBundle
	{
		public $sourcePath = __DIR__.'/assets';

		public $js = [
			['js/upload.js?','position' => View::POS_END],
		];

		public $css = [
			'css/upload.css',
		];
	}