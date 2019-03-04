<?php
namespace app\helpers;

use yii\helpers\Url;

class PhoneDigits
{
    public static function get($phoneField)
    {
        $phonedigits = str_replace(")", "", str_replace("(", "", str_replace("-", "", substr($phoneField, 3))));
        return $phonedigits;
    }
}
