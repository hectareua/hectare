<?php
	namespace app\modules\documentflow\components;
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-24
	 * Time: 21:51
	 */
	use yii\base\Object;

	class Document  extends Object
	{
		/**
		 * @var \app\modules\documentflow\Module
		 */
		private $_module;

		public $module = 'documentflow';

		/**
		 * Dispatcher constructor.
		 * @param array $config
		 */
		public function __construct(array $config = [])
		{
			parent::__construct($config);

			$this->_module = \Yii::$app->getModule($this->module);
		}

		/**
		 * @return array
		 * @throws \yii\base\InvalidConfigException
		 */
		public function modules()
		{
			return $this->_module->run();
		}
	}