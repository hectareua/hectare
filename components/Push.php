<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\data\ActiveDataProvider;
use paragraph1\phpFCM\Client;
use paragraph1\phpFCM\Message;
use paragraph1\phpFCM\Recipient\Device;
use paragraph1\phpFCM\Notification;

class Push extends Component
{
    protected $_manager = null;
//    public $apiKey = 'AAAA0SsKwzY:APA91bF3k-rGgvU3LtIFfxgK7yU4k9QM_fNALshPlOxJziY56iebTSmGBK0QSHjZ05Yc5mDcAhmEHDVpa6jojS3r8YcOill1xH91FXPDB4IMorZTgzTZDtjFgWIwYfNCU6r29UbtKtaS';
    
    //prod
    //public $apiKey = 'AAAAHrBb-pA:APA91bEPGkCb_D3rJzOgUl7wHX-at_0tSynTjPUWj4Rg5YbIcLdrZdltltY4GtPgFOn9UyX6nr6WvWXNglSdEotg7RPMY68iZIWStZhmmRa8r0QLrkdb6rC_i07FleQ5aUMJDD6e1udW';

    // prod 2
    public $apiKey = 'AAAAHrBb-pA:APA91bFPs_18ZACQKQ09d-YDuUpTmSazTRnxPbiTGg9Jzw60nZLxcYHSKopmv0Fi7Wr7AagXIo3hxEKHNtyTGTRrrjoxTKT8MG4FW8oH-Tdl4GtA1RYsI4ewT_W-4-CbnRStilpYSdO8';

// test
    // public $apiKey = 'AAAA3kVgNR4:APA91bHEnG4BsgJuILgSPDUtboYEa-erk2zFMmqNC-hbZseU7LgmkRTEkqWhocI6-ry1jC7NULyI-ZTp1wyw3M5y7ONmrYrbu1DvC9gkiWQiwgzH3UaljvgPezw4cfskxLOhvz7HMdIj';

    public $apiUrl = 'https://fcm.googleapis.com/fcm/send';
    public $timeout = 5;
    public $sslVerifyHost = false;
    public $sslVerifyPeer = false;
    public $maxMessageLength = 300;

    public function init()
    {
        if (!$this->apiKey)
            throw new \Exception('apiKey should be configured to use Push component');
    }
    
    public function send($route = '', $title, $message, $token)
    {
        if(strlen($token)<150)
        {
            return;
        }
        $headers = [
            'Content-Type: application/json',
            "Authorization:key={$this->apiKey}",
            'Expect: ',
        ];

        $this->correctNotificationText($title, $message);
        $body = [
            "to" => $token,
            "data" => [
                "route" => $route,
            ],
            "notification" => [
                "title" => $title,
                "body" => $message,
                "route" => $route,
                "icon" => 'https://hectare.com.ua/favicons/apple-touch-icon-180x180.png',
                "sound" => 'default',
                "color" => '#FFFFFF',
                "badge" => 1,
                "click_action" => "FCM_PLUGIN_ACTIVITY"
            ],
        ];

        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_SSL_VERIFYHOST => $this->sslVerifyHost,
            CURLOPT_SSL_VERIFYPEER => $this->sslVerifyPeer,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_FRESH_CONNECT => false,
            CURLOPT_FORBID_REUSE => false,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_POSTFIELDS => json_encode($body, true)
        ]);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function send2($route = '', $title, $message, $token)
    {
        $client = new Client();
        $client->setApiKey($this->apiKey);
        $client->injectHttpClient(new \GuzzleHttp\Client());

        $this->correctNotificationText($title, $message);
//        $note = new Notification($title, $message);
        $note = new Notification($title, $message);
        $note->setIcon('https://hectare.com.ua/favicons/apple-touch-icon-180x180.png')
            ->setColor('#ffffff')
            ->setBadge(1);
//            ->setClickAction($route);

        $message = new Message();
        $message->addRecipient(new Device($token));
        $message->setNotification($note)
            ->setData(array('route' => $route));

        $response = $client->send($message);
        return $response->getStatusCode();
    }

    private function correctNotificationText(&$title, &$message)
    {
        $message = strip_tags($message);
        $title = strip_tags($title);
        if (strlen($message) < $this->maxMessageLength) return;
        $message = substr($message, 0, $this->maxMessageLength - 1);
        $message .= "...";
    }

//    public function send($route = '', $title, $message, $token)
//    {
//        $headers = [
//            "Authorization:key={$this->apiKey}",
//            'Content-Type: application/json',
//            'Expect: ',
//        ];
//        $this->correctNotificationText($title, $message);
//        $body = [
//            "to" => $token,
//            "data" => [
//                "title" => $title,
//                "body" => $message,
//                "route" => $route,
//                "icon" => "notify",
//                "sound" => 'default',
//                "color" => '#FFFFFF',
//                "click_action" => "FCM_PLUGIN_ACTIVITY"
//            ]
//        ];
//        $ch = curl_init($this->apiUrl);
//        curl_setopt_array($ch, [
//            CURLOPT_POST           => true,
//            CURLOPT_SSL_VERIFYHOST => $this->sslVerifyHost,
//            CURLOPT_SSL_VERIFYPEER => $this->sslVerifyPeer,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_BINARYTRANSFER => true,
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_HEADER         => false,
//            CURLOPT_FRESH_CONNECT  => false,
//            CURLOPT_FORBID_REUSE   => false,
//            CURLOPT_HTTPHEADER     => $headers,
//            CURLOPT_TIMEOUT        => $this->timeout,
//            CURLOPT_POSTFIELDS     => json_encode($body, true)
//        ]);
//        $result = curl_exec($ch);
//        curl_close($ch);
//    }
}
