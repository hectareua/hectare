<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Plants;

class PlantsForm extends Plants
{
    use \app\modules\admin\models\traits\ImageUpload;
}
