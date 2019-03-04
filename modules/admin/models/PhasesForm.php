<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Phases;

class PhasesForm extends Phases
{
    use \app\modules\admin\models\traits\ImageUpload;
}
