<?php

namespace app\modules\web\models;

use Yii;
use app\models\User;

class UserForm extends User
{
    public $passwordConfirmation;
    protected $_password;

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['passwordValue', 'passwordConfirmation'], 'required'];
        $rules[] = ['passwordConfirmation', 'compare', 'compareAttribute' => 'passwordValue', 'message' => Yii::t('web', 'Пароли не совпадают')];
        return $rules;
    }

    public function setPasswordValue($value)
    {
        $this->password = $this->_password = $value;
    }

    public function getPasswordValue()
    {
        return $this->_password;
    }
}
