<?php
namespace app\helpers;

use app\models\Image;
use sadovojav\image\Thumbnail;
use Yii;

class Helper
{
    /**
     * @param $number
     * @param $after (1, 2, 5)
     * @return string
     */
    public static function pluralForm($number, $after)
    {
        $cases = array (2, 0, 1, 1, 1, 2);
        return $number.' '.$after[ ($number%100>4 && $number%100<20)? 2: $cases[min($number%10, 5)] ];
    }

    /**
     * @param $image Image
     * @param $width
     * @param $height
     * @return mixed
     */
    public static function thumbnail($image, $width, $height)
    {
        $exploded = explode('/', $image->url);
        $file = Yii::getAlias(Image::BASE_UPLOAD_PATH) . '/' . end($exploded);
        if (is_file($file) && $_SERVER['HTTP_HOST'] == parse_url($image->url, PHP_URL_HOST)) {
            $img = getimagesize($file);
            if ($img[0] >= $img[1]) {
                return Yii::$app->thumbnail->url($file, [
                    'resize' => [
                        'width' => $width,
                    ],
                        'quality' => 80,
                    ]);
            } else {
                return Yii::$app->thumbnail->url($file, [
                    'resize' => [
                        'height' => $height,
                    ],
                        'quality' => 80,
                    ]);
            }
        } else {
            return $image->url;
        }
    }
}
