<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 25.02.2019
 * Time: 0:15
 */

namespace app\components\delivery;


class DeliveryCalculator
{
    const PRICE_TO_HOME_PER_KM = 8;
    const PRICE_MOMENT_TO_HOME_PER_KM = 10;

    /**
     * @var float|integer
     */
    protected $priceByKm;

    /**
     * This method calculates delivery price
     *
     * @param $distance
     * @return float|int
     */
    public function calculateDeliveryPrice($distance)
    {
        $price = $distance * 2 * $this->priceByKm;
        $price = ceil($price);

        return $price;
    }

    /**
     * @param $distance
     * @param integer $orderPrice
     * @return string
     */
    public function output($distance, $orderPrice)
    {
        return '';
    }

    /**
     * @param $distance
     * @param $orderPrice
     * @return bool
     */
    public function isFree($distance, $orderPrice)
    {
        return false;
    }
}
