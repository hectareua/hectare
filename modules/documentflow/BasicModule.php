<?php

namespace app\modules\documentflow;

use app\modules\documentflow\components\Controller;
/**
 *
 * Class Module
 * @package app\modules\documentflow\components
 *
 */
class BasicModule extends \yii\base\Module
{
    /**
     * @var string controller name
     */
    public $defaultControllerName = 'DocumentController';

    /**
     * @var string modules namespace
     */
    private $_modulesNamespace;

    /**
     * @var string absolute path to modules dir
     */
    public $modulePath;


    public $dataModel = [];

    /**
     *
     * @throws \yii\base\InvalidParamException
     */
    public function init()
    {
        parent::init();
        $this->_setModuleVariables();
    }

    /**
     * @return array
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
		$data = [];
		if ($controller = $this->findModuleController()) {
			$data = \Yii::createObject($controller, ['documentflow', $this])->index();
		}
        return $data;
    }

    /**
     * @return null|strin
     */
    public function findModuleController()
    {
        $className = $this->_modulesNamespace . '\\controllers\\' . $this->defaultControllerName;
        return is_subclass_of($className, Controller::className()) ? $className : null;
    }

    /**
     * Set modules namespace and path
     */
    private function _setModuleVariables()
    {
        $class = new \ReflectionClass($this);
        $this->_modulesNamespace = $class->getNamespaceName();
        $this->modulePath = dirname($class->getFileName());
    }
}