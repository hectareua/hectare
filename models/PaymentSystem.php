<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_system".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property Order[] $orders
 */
class PaymentSystem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_system';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk', 'name_ru'], 'required'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => 'Назва українською',
            'name_ru' => 'Назва російською',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_system_id' => 'id']);
    }

    public function getName()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->name_ru;
        case 'uk':
        default:
            return $this->name_uk;
        }
    }

    public function getDescription()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->description_ru;
            case 'uk':
            default:
                return $this->description_uk;
        }
    }
}
