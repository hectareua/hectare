<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Category;

class CategoryForm extends Category
{
    use \app\modules\admin\models\traits\ImageUpload;
}
