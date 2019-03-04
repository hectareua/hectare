<?php
namespace app\modules\admin\models;

use app\models\ProductBonus;
use Yii;

class ProductBonusForm extends ProductBonus
{
    use \app\modules\admin\models\traits\ImageUpload;
}