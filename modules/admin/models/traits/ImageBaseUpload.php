<?php

namespace app\modules\admin\models\traits;

use Yii;
use yii\web\UploadedFile;
use app\models\Image;

trait ImageBaseUpload
{

    public function saveImage($image, \yii\web\UploadedFile $file , $file_url) {

        if (!$image)
        {
            $image = new Image();
        }

        if ($file)
        {
            if (!$image->saveUploadedFile($file))
                return false;
        }
        elseif ($image->url != $file_url)
        {
            if (!$image->saveUrl($file_url))
                return false;
        }

        return $image;

    }
}
