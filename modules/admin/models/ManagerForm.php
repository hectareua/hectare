<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Manager;

class ManagerForm extends Manager
{
    use \app\modules\admin\models\traits\TwoImagesUpload;
}
