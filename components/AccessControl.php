<?php

namespace app\components;

use Yii;

class AccessControl extends \yii\filters\AccessControl
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;
        if (!$this->user->isGuest && !$this->user->identity->is_admin)
            $this->denyAccess($this->user);
        return true;
    }
}
