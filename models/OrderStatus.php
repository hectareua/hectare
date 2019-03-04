<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_status".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property Order[] $orders
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    const CLOSED_ORDER_STATUS_ID = 7;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_status';
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
            'name_uk' => 'Name Uk',
            'name_ru' => 'Name Ru',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['status_id' => 'id']);
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
}
