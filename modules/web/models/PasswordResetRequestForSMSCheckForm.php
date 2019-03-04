<?php

namespace app\modules\web\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * Password reset request form
 */
class PasswordResetRequestForSMSCheckForm extends PasswordResetRequestForSMSBase
{
    public $billing_phone;
    public $validation_code;
    //public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['validation_code', 'string'],
            ['validation_code', 'required'],
        ];
    }


    public function userHasValidationCode()
    {
        /* @var $user User */

        $user = $this->getUserByPhone();

        if (!$user) {
            return false;
        }
        if ($user->validation_code) {
            return true;
        }
    }
}
