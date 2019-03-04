<?php
namespace app\modules\admin\models;

use Yii;
use app\models\ManagerTrophy;

class ManagerTrophyForm extends ManagerTrophy
{
    use \app\modules\admin\models\traits\ImageUpload;
}