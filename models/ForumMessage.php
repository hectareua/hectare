<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Forum;

/**
 * This is the model class for table "forum_message".
 *
 * @property integer $id
 * @property integer $forum_id
 * @property string $created_at
 * @property integer $user_id
 * @property string $text
 *
 * @property User $user
 * @property Forum $forum
 */
class ForumMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum_message';
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
                    ['html' => 'newForumMessage-html', 'text' => 'newForumMessage-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Нове повідомлення на форумі")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['forum_id', 'user_id', 'text'], 'required'],
            [['forum_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['text'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['forum_id'], 'exist', 'skipOnError' => true, 'targetClass' => Forum::className(), 'targetAttribute' => ['forum_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'forum_id',
            'created_at' => function($model){return strtotime($model->created_at);},
            'user',
            'text',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forum_id' => 'Форум',
            'created_at' => 'Дата створення',
            'user_id' => 'Користувач',
            'text' => 'Повідомлення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForum()
    {
        return $this->hasOne(Forum::className(), ['id' => 'forum_id']);
    }

    public function getAllforums()
    {
        return ArrayHelper::map(Forum::find()->all(), 'id', 'name');
    }
}
