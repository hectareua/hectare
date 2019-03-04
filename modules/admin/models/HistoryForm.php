<?php
namespace app\modules\admin\models;

use Yii;
use app\models\History;

class HistoryForm extends History
{
    use \app\modules\admin\models\traits\ImageUpload;
}
