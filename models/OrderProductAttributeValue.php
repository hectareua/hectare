<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product_attribute_value".
 *
 * @property integer $id
 * @property integer $order_product_id
 * @property integer $attribute_value_id
 *
 * @property AttributeValue $attributeValue
 * @property OrderProduct $orderProduct
 */
class OrderProductAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product_attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_product_id', 'attribute_value_id'], 'required'],
            [['order_product_id', 'attribute_value_id'], 'integer'],
            [['attribute_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['attribute_value_id' => 'id']],
            [['order_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderProduct::className(), 'targetAttribute' => ['order_product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_product_id' => 'Order Product ID',
            'attribute_value_id' => 'Attribute Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'attribute_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProduct()
    {
        return $this->hasOne(OrderProduct::className(), ['id' => 'order_product_id']);
    }
}
