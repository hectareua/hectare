<?php
namespace app\modules\web\models;
use Yii;
use yii\base\Model;

/**
 * Created by PhpStorm.
 * User: royk09
 * Date: 12.12.2018
 * Time: 22:24
 */

class PartnerForm extends Model
{
    public $email;
    public $name;
    public $phone;

    public function sendMail()
    {
        $receiverEmail = \app\models\SiteInfo::loadData()->contacts_email;
        if ($receiverEmail)
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'newPartner-html', 'text' => 'newPartner-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo('hectare.com.ua@gmail.com')
                ->setSubject("Нове співробітництво")
                ->send();
        return true;
    }

    public function rules()
    {
        return [
            ['email', 'trim'],
            [['email','name','phone'], 'required'],
            ['email', 'email'],
            [['name','phone'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ім\'я',
            'email' => 'Email',
            'phone' => 'Телефон'
        ];
    }

}