<?php
namespace app\modules\admin\models;

use app\models\InfoSlider;
use Yii;

class InfoSliderForm extends InfoSlider
{
    use \app\modules\admin\models\traits\ImageUpload;
}