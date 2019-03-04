<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_value".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $option_id
 * @property string $price
 *
 * @property AttributeOption $option
 * @property Product $product
 * @property OrderProductAttributeValue[] $orderProductAttributeValues
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'option_id'], 'required'],
            [['product_id', 'option_id'], 'integer'],
            [['price'], 'number'],
            [['opt', 'opt1', 'opt_uk', 'opt_uk1'], 'integer'],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeOption::className(), 'targetAttribute' => ['option_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'option',
            'price' => function()
            {
                return round((float)$this->_calculatePrice(), 2);
            },

            'opt',
            'opt_uk' => function()
             {
                return $this->_calculateOptPrice();
             },
            'opt1',
            'opt_uk1' => function()
             {
                return $this->_calculateOptPrice1();
             }

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
            'option_id' => 'Option ID',
            'price' => 'Price',
        ];
    }

    public function getCurrencyPrice()
    {
        return round($this->_calculatePrice() * $this->product->getDiscountRate(), 2);
    }

    public function getRealPrice()
    {
        return round($this->_calculatePrice(), 2);
    }

    public function getCurrencyOptPrice()
    {
        return round($this->_calculateOptPrice() * $this->product->getDiscountRate(), 2);
    }

    public function getRealOptPrice()
    {
        return round($this->_calculateOptPrice(), 2);
    }

    public function getCurrencyOptPrice1()
    {
        return round($this->_calculateOptPrice1() * $this->product->getDiscountRate(), 2);
    }

    public function getRealOptPrice1()
    {
        return round($this->_calculateOptPrice1(), 2);
    }

    /**
     * @return float
     */
    public function getCurrencyOldPrice()
    {
        if ($this->product->getDiscountRate() === 1.0)
            return 0.0;

        return $this->realPrice;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(AttributeOption::className(), ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProductAttributeValues()
    {
        return $this->hasMany(OrderProductAttributeValue::className(), ['attribute_value_id' => 'id']);
    }

    public function _calculatePrice()
    {
        return $this->product->currency->rate * (float)$this->price ;
    }

    protected function _calculateOptPrice()
    {
        return $this->product->currency->rate * (float)$this->opt_uk/100;
    }

    protected function _calculateOptPrice1()
    {
        return $this->product->currency->rate * (float)$this->opt_uk1/100;
    }


}
