<?php
	/**
	 * Created by PhpStorm.
	 * User: prosspa
	 * Date: 2019-02-24
	 * Time: 17:07
	 */

	namespace app\modules\documentflow\components;

	class Controller extends \yii\web\Controller
	{

		/**
		 * @param string $view
		 * @param array $params
		 * @return string
		 * @throws \yii\base\InvalidParamException
		 * @throws \yii\base\ViewNotFoundException
		 * @throws \yii\base\InvalidCallException
		 */
		public function render($view, $params = [])
		{
			$view_path = str_replace('Controller', '', $this->module->defaultControllerName);
			$path = '@app/modules/'. $this->id . '/views/' . $view_path . '/' . $view;
			return $this->getView()->render($path, $params, $this);
		}
	}