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
     * @return DeliveryCalculator|null
     */
    public static function create($deliveryType)
    {
        switch ($deliveryType){
            case Order::DELIVERY_TYPE_TO_HOME:
                $deliveryCalculator = new HomeDelivery();
                break;
            case Order::DELIVERY_TYPE_MOMENT_TO_HOME:
                $deliveryCalculator = new MomentDelivery();
                break;
            default:
                $deliveryCalculator = null;
                break;
        }

        return $deliveryCalculator;
    }
}
