<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "callback_request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $phone
 * @property string $requested_at
 *
 * @property User $user
 */
class CallbackRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'callback_request';
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
                    ['html' => 'callbackRequest-html', 'text' => 'callbackRequest-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Обратная связь")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['servicetype', 'phone', 'question', 'orderno', 'name','message', 'requested_at'], 'required'],
            [['question','servicetype','orderno','requested_at'], 'safe'],
            [['name', 'phone','message'], 'string', 'max' => 255],
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
            'servicetype' => 'servicetype',
            'question' => 'question',
            'orderno' => 'orderno',
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
