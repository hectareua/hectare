<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_review".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $comment
 * @property integer $rating_delivery
 * @property integer $rating_service
 * @property integer $rating_work
 * @property string $created_at
 *
 * @property User $user
 */
class UserReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_review';
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
                    ['html' => 'userReview-html', 'text' => 'userReview-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Новий відгук користувача")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'rating_delivery', 'rating_service', 'rating_work', 'created_at'], 'required'],
            [['user_id', 'rating_delivery', 'rating_service', 'rating_work'], 'integer'],
            [['comment'], 'string'],
            [['created_at'], 'safe'],
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
            'comment' => 'Коментар',
            'rating_delivery' => 'Оцінка доставки',
            'rating_service' => 'Оцінка сервісу',
            'rating_work' => 'Оцінка роботи',
            'created_at' => 'Дата створення',
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
