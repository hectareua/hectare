<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_question".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $text
 * @property string $asked_at
 *
 * @property User $user
 * @property Product $product
 */
class ProductQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_question';
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
                    ['html' => 'productQuestion-html', 'text' => 'productQuestion-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Нове питання до продукту")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'name', 'email', 'phone', 'text', 'asked_at'], 'required'],
            [['product_id', 'user_id'], 'integer'],
            [['text'], 'string'],
            [['asked_at'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'name' => 'Ім\'я',
            'email' => 'Електронна адреса',
            'phone' => 'Телефон',
            'text' => 'Текст',
            'asked_at' => 'Дата створення',
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
