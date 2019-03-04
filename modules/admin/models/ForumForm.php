<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Forum;

class ForumForm extends Forum
{
    use \app\modules\admin\models\traits\ImageUpload;
}
