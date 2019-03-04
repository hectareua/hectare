<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Slide;

class SlideForm extends Slide
{
    use \app\modules\admin\models\traits\ImageUploadMultiLanguage;
}
