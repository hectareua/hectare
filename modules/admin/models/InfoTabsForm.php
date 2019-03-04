<?php
/**
 * Created by PhpStorm.
 * User: royk09
 * Date: 10.12.2018
 * Time: 0:03
 */
namespace app\modules\admin\models;

use app\models\InfoSlider;
use app\models\InfoTabs;
use Yii;

class InfoTabsForm extends InfoTabs
{
    use \app\modules\admin\models\traits\ImageUpload;
}