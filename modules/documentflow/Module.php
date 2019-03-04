<?php

	namespace app\modules\documentflow;
	use Yii;
	/**
	 * admin module definition class
	 */
	class Module extends BasicModule
	{
		/**
		 * @inheritdoc
		 */
		public function init()
		{
			$this->setAliases(['@documentflow-assets' => __DIR__.'/assets']);
			$this->setAliases(['@documentflow' => __DIR__]);
			Assets::register(Yii::$app->view);
			parent::init();
		}
	}
