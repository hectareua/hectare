<?php

namespace app\modules\web\models;

use Yii;
use app\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForSMSGenerateForm extends PasswordResetRequestForSMSBase
{
    public $billing_phone;
    // public $captcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['billing_phone', 'trim'],
            ['billing_phone', 'required'],
            ['billing_phone', 'exist',
                'targetClass' => '\app\models\Client',
                'message' => Yii::t('web', 'Пользователя с таким телефоном не существует.')
            ],
            // ['captcha', 'required'],
            // ['captcha', 'captcha', 'captchaAction' => '/web/default/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'billing_phone' => 'Телефон',
        ];
    }

    public function sendSMS()
    {
        /* @var $user User */

        $user = $this->getUserByPhone();

        if (!$user) {
            return false;
        }

       $rand = (string)rand(0,9999);
       $randLen = strlen($rand);
       $password = $randLen < 4 ? str_repeat ('0', 4-$randLen).$randLen : $rand;
       $user->setValidationCode($password);
       if (!$user->save()) {
            return false;
       }

        return Yii::$app->epochtasms->sendSMS('Code:'.$password, '38'.$user->client->billing_phone, 'Gektar');

        /*
        $file = 'sms.txt';
        $sms = file_get_contents($file);
        $sms .= $return;
        $sms .= 'Code:'.$password."\n";
        file_put_contents($file, $sms);
        return true;
        */

    }
}
