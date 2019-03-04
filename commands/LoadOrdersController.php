<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Order;
use app\models\OrderStatus;

class LoadOrdersController extends Controller {

    private $fileName = '1c_orders';

    public function actionIndex() {
        $result = $this->loadOrders();
        if ($result){
            Yii::$app->get('parser')->deleteXML(['name' => $this->fileName]);
        }
    }

    public function loadOrders() {

        $one_c_orders = Yii::$app->get('parser')->getArray(['name' => $this->fileName]);

        if ($one_c_orders) {
            foreach($one_c_orders['orders'] as $one_c_order) {

                if (!(Order::find()->where(['one_c_order_id' => $one_c_order['one_c_id']])->one())) {

                    $order = new Order();
                    if (isset($one_c_order['bonus_wrote_off'])) {
                        $order->bonus_write_off = (int) $one_c_order['bonus_wrote_off'];
                        $order->bonus_write_off_request = (int) $one_c_order['bonus_wrote_off'];
                    }

                    if (isset($one_c_order['bonus_got'])) {
                        $order->bonus_got = (int) $one_c_order['bonus_got'];
                    }

                    if (isset($one_c_order['products'])) {
                        $order->products_one_c = $one_c_order['products'];
                    }

                    if (isset($one_c_order['email'])) {
                        $order->billing_email = $one_c_order['email'];
                    } else {
                        //$order->billing_email = 'test@ukr.net';
                    }

                    if (isset($one_c_order['phone'])) {
                        $order->billing_phone = $one_c_order['phone'];
                    }

                    if (isset($one_c_order['one_c_id'])) {
                        $order->one_c_order_id = $one_c_order['one_c_id'];
                    }

                    if (isset($one_c_order['client_id'])) {
                        $order->client_id = (int) $one_c_order['client_id'];
                    }

                    if (isset($one_c_order['ordered_at'])) {
                        $order->ordered_at = date('Y-m-d H:i:s',$one_c_order['ordered_at']) ;
                    }

                    if (isset($one_c_order['fullname'])) {
                        $order->billing_fullname = $one_c_order['fullname'];
                    }

                    if (isset($one_c_order['payment_system_id'])) {
                        $order->payment_system_id = (int) $one_c_order['payment_system_id'];
                    }

                    if (isset($one_c_order['one_c_price'])) {
                        $order->one_c_price = (int) $one_c_order['one_c_price'];
                    }

                    $order->status_id = OrderStatus::CLOSED_ORDER_STATUS_ID;
                    $order->is_one_c_order = 1;

                    if (!$order->save()) {
                        echo date("F j, Y, g:i a") . " error of saving 1C order:" . $one_c_order['one_c_id'] . "\n";
                        return false;
                    } else {
                        echo date("F j, Y, g:i a") . " success of  saving 1C order:" . $one_c_order['one_c_id'] . "\n";
                    }
                }
            }
        } else {
            echo date("F j, Y, g:i a") . " file are not exist! \n";
            return false;
        }

        return true;
        //var_dump($one_c_orders);
    }
}
