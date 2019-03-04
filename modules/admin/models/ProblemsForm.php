<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Problems;

class ProblemsForm extends Problems
{
    use \app\modules\admin\models\traits\ImageUpload;
}
