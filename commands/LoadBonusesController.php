<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Order;

class LoadBonusesController extends Controller
{
    private $fileName = 'bonus';

    public function actionIndex()
    {
        $result = $this->loadBonuses();

        if ($result) {
            Yii::$app->get('parser')->deleteXML(['name' => $this->fileName]);
        }
    }

    private function loadBonuses()
    {
        $bonuses = Yii::$app->get('parser')->getArray(['name' => $this->fileName]);
        $orders = Order::find()->where('!ISNULL(client_id)')->andFilterWhere(['or', 'ISNULL(bonus_got)', ['and', 'ISNULL(bonus_write_off)', '!ISNULL(bonus_write_off_request)']])->all();

        if ($bonuses) {
            foreach($orders as $order) {
                foreach($bonuses['root'] as $note) {
                    if ($note['order_id'] == $order->id ) {
                        if (isset($note['bonus_wrote_off'])) {
                            $order->bonus_write_off = (int)$note['bonus_wrote_off'];
                        }
                        if (isset($note['bonus_got'])) {
                            $order->bonus_got = (int)$note['bonus_got'];
                        }

                        if (!$order->save()) {
                            echo date("F j, Y, g:i a").' error of bonuses saving in order:'.$order->id."\n";
                            return false;
                        } else {
                            echo date("F j, Y, g:i a").' success of bonuses saving in order: '.$order->id."\n";
                        }
                    }
                }
            }
        } else {
            echo date("F j, Y, g:i a")." file are not exist! \n";
            return false;
        }

        return true;
        //var_dump($orders );
        //var_dump($bonuses);
    }
}
