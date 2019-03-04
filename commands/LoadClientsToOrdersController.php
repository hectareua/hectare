<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Client;

class LoadClientsToOrdersController extends Controller {

    public function actionIndex() {

        $clients = Client::find()->with('ordersViaPhone')->all();

        foreach($clients as $client) {
            foreach($client->ordersViaPhone as $orderViaPhone) {
                $orderViaPhone->client_id = $client->id;
                if (!$orderViaPhone->save()) {
                    echo date("F j, Y, g:i a") . " error of updating client ID in order:" . $orderViaPhone->id . "\n";
                } else {
                    echo date("F j, Y, g:i a") . ' order' . $orderViaPhone->id . " is updated  with client ID:" . $orderViaPhone->client_id . "\n";
                }
            }
        }
        //var_dump($clients );
    }
}
