<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 25.02.2019
 * Time: 0:25
 */

namespace app\components\delivery;


use app\models\Order;

class DeliveryFactory
{
    /**
     * @param $deliveryType
     * @param integer $weight
     * @return DeliveryCalculator|null
     */
    public static function create($deliveryType, $weight = 0)
    {
        switch ($deliveryType){
            case Order::DELIVERY_TYPE_TO_HOME:
                $deliveryCalculator = new HomeDelivery($weight);
                break;
            case Order::DELIVERY_TYPE_MOMENT_TO_HOME:
                $deliveryCalculator = new MomentDelivery($weight);
                break;
            default:
                $deliveryCalculator = null;
                break;
        }

        return $deliveryCalculator;
    }
}
