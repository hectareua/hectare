<?php
namespace app\modules\admin\models;

use Yii;
use app\models\Manager;

class ManagerUserForm extends Manager
{
    use \app\modules\admin\models\traits\TwoImagesUpload;

    public $pass;
    public $lastName;
    public $firstName;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [['pass'], 'safe'],
            [['pass', 'lastName', 'firstName', 'phone', 'imageFile'], 'required'],
        ]);
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'pass' => 'Пароль',
            'lastName' => Yii::t('web', 'Фамилия'),
            'firstName' => Yii::t('web', 'Имя'),
        ]);
    }

}