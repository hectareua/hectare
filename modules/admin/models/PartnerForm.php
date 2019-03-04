<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Partner;

class PartnerForm extends Partner
{
    use \app\modules\admin\models\traits\ImageUpload;
}
