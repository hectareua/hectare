<?php
namespace app\modules\admin\models;

use app\models\SaveWithUs;
use Yii;

class SaveWithUsForm extends SaveWithUs
{
    use \app\modules\admin\models\traits\ImageUpload;
}