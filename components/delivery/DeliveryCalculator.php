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
    const PRICE_MORE_THAT_500_KG = 12;

    /**
     * @var float|integer
     */
    protected $priceByKm;

    public function __construct($weight)
    {
        if ($weight >= 500){
            $this->priceByKm = self::PRICE_MORE_THAT_500_KG;
        }
    }

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
