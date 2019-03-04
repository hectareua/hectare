<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Article;

class ArticleForm extends Article
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
