<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 23.02.2019
 * Time: 1:18
 */

namespace app\components;

use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * Class GoogleMapComponent
 * @package app\components
 */
class GoogleMapComponent extends Component
{
    /**
     * @var string
     */
    public $key;

    /**
     * @var array
     */
    private $voznisenksShopCoordinates = [
        'lat' => 47.5953712,
        'long' => 31.3171168
    ];

    public function init()
    {
        parent::init();

        if (!$this->key){
            throw new InvalidConfigException('$key param is required.');
        }
    }

    /**
     * This method returns lat and lng of places
     *
     * @param $city
     * @param $street
     * @return mixed
     */
    private function getCoordinates($city, $street)
    {
        $address = urlencode($city . ',' . $street);
        $url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=Ukraine";
        $url .= '&key=' . $this->key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $responseDecoded = json_decode($response);

        if (isset($responseDecoded->results[0])){
            $return = [
                'lat' => $responseDecoded->results[0]->geometry->location->lat,
                'long' => $long = $responseDecoded->results[0]->geometry->location->lng
            ];
        } else {
            $return = [];
        }

        return $return;
    }

    /**
     * This method returns ...
     *
     * @param $city
     * @param $street
     * @return string
     * @throws \Exception
     */
    public function getDistanceFromShop($city, $street)
    {
        $coordinatesVoznesenk = $this->voznisenksShopCoordinates;
        $coordinatesPoint = self::getCoordinates($city, $street);

        if (!$coordinatesVoznesenk || empty($coordinatesPoint)) {
            throw new \Exception('Bad address.');
        }

        $dist = self::getDrivingDistance(
            $coordinatesVoznesenk['lat'],
            $coordinatesPoint['lat'],
            $coordinatesVoznesenk['long'],
            $coordinatesPoint['long']
        );
        return $dist;
    }

    private function getDrivingDistance($lat1, $lat2, $long1, $long2)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1.
            "&destinations=".$lat2.",".$long2."&mode=driving&language=pl-PL";
        $url .= '&key=' . $this->key;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);

        $dist = $response_a['rows'][0]['elements'][0]['distance']['value'] / 1000;
        $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

        return ['distance' => $dist, 'time' => $time];
    }
}
