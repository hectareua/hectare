<?php

namespace app\modules\web\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Client;
/**
 * Password reset request form
 */
class PasswordResetRequestForSMSBase extends Model
{
    public function getUserByPhone()
    {
        /* @var $user User */

        $client = Client::findOne([
            'billing_phone' => $this->billing_phone,
        ]);

        if (!$client) return null;

        $user = User::findOne([
            'id' => $client->user_id
        ]);

        return $user;
    }

}
