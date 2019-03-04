<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 25.02.2019
 * Time: 0:23
 */

namespace app\components\delivery;


class MomentDelivery extends DeliveryCalculator
{
    protected $priceByKm = self::PRICE_MOMENT_TO_HOME_PER_KM;

    const PERCENT_FOR_FREE = 0.03;

    /**
     * @param $distance
     * @param integer $orderPrice
     * @return string
     */
    public function output($distance, $orderPrice)
    {
        $deliveryPrice = $this->calculateDeliveryPrice($distance);

        $criterion = $deliveryPrice / self::PERCENT_FOR_FREE - $orderPrice;

        if ($criterion < 0){
            $return = '<div class="delivery-free">Доступно безкоштовно</div>';
        } else {
            $return = '<div class="delivery-free">Для безкоштовної доставки докупіть на ' . ceil($criterion) . ' грн.</div>';
        }

        return $return;
    }

    /**
     * @param $distance
     * @param $orderPrice
     * @return bool
     */
    public function isFree($distance, $orderPrice)
    {
        $deliveryPrice = $this->calculateDeliveryPrice($distance);
        $criterion = $deliveryPrice / self::PERCENT_FOR_FREE - $orderPrice;

        return $criterion < 0;
    }
}
