<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call_request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $phone
 * @property string $requested_at
 *
 * @property User $user
 */
class CallRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'call_request';
    }

    const EVENT_ON_CREATE = 'on-create';
    public function init()
    {
        $this->on(self::EVENT_ON_CREATE, [$this, 'sendMail']);
    }

    public function sendMail()
    {
        $receiverEmail = \app\models\SiteInfo::loadData()->contacts_email;
        if ($receiverEmail)
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'callRequest-html', 'text' => 'callRequest-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Замовлення на дзвінок")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name', 'phone', 'requested_at'], 'required'],
            [['requested_at'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Ім\'я',
            'phone' => 'Телефон',
            'requested_at' => 'Дата створення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
