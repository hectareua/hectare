<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Representative;

class RepresentativeForm extends Representative
{
    use \app\modules\admin\models\traits\ImageUpload;
}
