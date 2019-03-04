<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use app\models\Manager;


class LoadManagersController extends Controller
{
    private $fileName = 'user_manager';

    public function actionIndex() {
        $result = $this->loadManagers();

        if ($result){
            Yii::$app->get('parser')->deleteXML(['name' => $this->fileName]);
        }
    }

    private function loadManagers()
    {

        $users_managers = Yii::$app->get('parser')->getArray(['name' => $this->fileName]);
        $users = User::find()->where('ISNULL(manager_id)')->with('client')->all();
        //$users = User::find()->all();
        $managers = Manager::find()->all();

        if ($users_managers) {
            foreach($users as $user) {
                foreach($users_managers['user_manager'] as $user_manager) {
                    if (isset($user->client)) {
                        if ($user_manager['user_id'] == $user->client->billing_phone) {
                            foreach ($managers as $manager) {
                                if ($manager->id == $user_manager['manager_id']) {
                                    $user->manager_id = $user_manager['manager_id'];
                                    if (!$user->save()) {
                                        echo date("F j, Y, g:i a") . ' error of saving manager with id:' . $user_manager['manager_id'] . " for user:". $user->id. "\n";
                                        return false;
                                    } else {
                                        echo date("F j, Y, g:i a") . ' success of saving manager with id:' . $user->manager_id . " for user:". $user->id."\n";
                                        return true;
                                    }
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        } else {
            echo date("F j, Y, g:i a") . " file are not exist! \n";
            return false;
        }

        return true;
        //var_dump($users);
        //var_dump($users_managers);
    }
}
