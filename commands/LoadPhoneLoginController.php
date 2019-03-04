<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use app\models\Manager;


class LoadPhoneLoginController extends Controller
{
    private $fileName = 'user_manager';

    public function actionIndex() {
        $result = $this->loadLogins();

    }

    private function loadLogins()
    {
        $users = User::find()->with('client')->all();



        foreach($users as $user) {

            if ($user->client) {
                if (strlen($user->client->billing_phone) == 10) {
                    $user->login = $user->client->billing_phone;

                    if (!$user->save()) {
                        var_dump($user->errors);
                        echo date("F j, Y, g:i a") . ' error of saving login with user id:'. $user->id. "\n";

                    } else {
                        echo date("F j, Y, g:i a") . ' success of saving login with user id:' . $user->id."\n";

                    }
                 }
            } else {
                echo date("F j, Y, g:i a") . ' error of saving login with user id:'. $user->id.", he is not a client!\n";
            }
        }



        return true;
        //var_dump($users);
        //var_dump($users_managers);
    }
}
