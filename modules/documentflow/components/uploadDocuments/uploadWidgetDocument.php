<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-26
	 * Time: 00:13
	 */

	namespace app\modules\documentflow\components\uploadDocuments;

	use Assets;

	class uploadWidgetDocument extends \yii\base\Widget
	{

		public function init()
		{
			parent::init();
		}

		/**
		 * @return string
		 */
		public function run($model)
		{
			$view = $this -> getView();
			\app\modules\documentflow\components\uploadDocuments\Assets::register($view);
			return $this -> render('index',['model' => $model]);
		}
	}