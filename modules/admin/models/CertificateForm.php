<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Certificate;

class CertificateForm extends Certificate
{
    use \app\modules\admin\models\traits\ImageUpload;
}
