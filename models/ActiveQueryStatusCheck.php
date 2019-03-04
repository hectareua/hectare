<?php

namespace app\models;

use Yii;
use app\models\User;

class ActiveQueryStatusCheck extends \yii\db\ActiveQuery
{
    private $isAdmin = 0;
    public function init()
    {
        if (Yii::$app->user->id == null) {
            $this->isAdmin = 0;
        } else {
            $this->isAdmin = User::findOne(\Yii::$app->user->id)->is_admin;
        }

        $modelClass = $this->modelClass;
        $tableName = $modelClass::tableName();

        
        if ((\Yii::$app->controller->module->id != 'admin') && ($_SERVER['REQUEST_URI']!='/api/order/info')) {
        //&& (!$this->isAdmin)) {
                $this->andWhere([$tableName.'.status' => 0]);
        }
        parent::init();
    }

    public function where($condition, $params = [])
    {
        $modelClass = $this->modelClass;
        $tableName = $modelClass::tableName();
        $default = [];
        $return = parent::where($condition, $params = []);
       
        if ((\Yii::$app->controller->module->id != 'admin') && ($_SERVER['REQUEST_URI']!='/api/order/info')) {
            //&& (!$this->isAdmin)) {
            $this->andWhere([$tableName.'.status' => 0]);
        }
        return $return;
     }
} 

