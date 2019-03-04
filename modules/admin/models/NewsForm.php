<?php
namespace app\modules\admin\models;

use Yii;
use app\models\News;

class NewsForm extends News
{
    use \app\modules\admin\models\traits\ImageUpload;

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert))
            return false;
        if (!$this->publishing_since)
            $this->publishing_since = 0;
        if (!$this->publishing_till)
            $this->publishing_till = 0;
        return true;
    }
}
