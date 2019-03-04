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
            [['product_id', 'option_id','status'], 'integer'],
            [['price', 'part_price'], 'number'],
            [['code1c','code1c_buh'], 'string'],
            [['opt', 'opt1', 'opt_uk', 'opt_uk1'], 'number'],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeOption::className(), 'targetAttribute' => ['option_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => AvailabilityStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'option',
            /*'price' => function()
            {
                return round((float)$this->_calculatePrice(), 2);
            },*/
            'price'=> function()
            {
                return $this->getOptionPriceForAttribute();
            },
            'priceForOne' => function()
            {
                return $this->getOptionPriceForOneAttribute();
                // return round((float)$this->_calculatePrice(), 2);
            },
            'opt',
            'opt_uk' => function()
             {
                return round((float)$this->_calculateOptPrice(), 2);
             },
            'opt1',
            'opt_uk1' => function()
             {
                return round((float)$this->_calculateOptPrice1(), 2);
             },
            'status'
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
			'part_price' => 'Part Price',
            'code1c' => 'code1c',
			'code1c_buh' => 'Code1c_buh',
        ];
    }

    public function getCurrencyPrice()
    {
        return round($this->_calculatePrice() * $this->product->discountRate, 2);
    }
	
    public function getPartnerCurrencyPrice()
    {
        return round($this->_calculatePartnerPrice(), 2);
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

    public function getAvailabilityStatus()
    {
        return $this->hasOne(AvailabilityStatus::className(), ['id' => 'status']);
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
	
	public function _calculatePartnerPrice()
    {
        return $this->product->currency->rate * (float)$this->part_price ;
    }

    protected function _calculateOptPrice()
    {
        return $this->product->currency->rate * (float)$this->opt_uk/100;
    }

    protected function _calculateOptPrice1()
    {
        return $this->product->currency->rate * (float)$this->opt_uk1/100;
    }

    public function getStock()
    {
        return $this->hasMany(Stock::className(), ['avid' => 'id']);
    }
    
    public function getOptionPriceForAttribute()
    {

        $price = $this->price;
        if ($price)
        {
            $price = $this->product->_convertPrice($price) * $this->product->getDiscountRate();
        }else{
            $price = $this->product->getCurrencyPrice();
        }

        $multi = $this->option->multiplier;

        $new_price = 0;

        $litr = 10000;
        $kg = 10000;


        if($this->product->ykazatel == 'л')
        {
            $new_price = ($price*$multi)/$litr;
        }
        if($this->product->ykazatel == 'кг')
        {
            $new_price = ($price*$multi)/$kg;
        }
        
        if($new_price == 0)
        {
            $new_price = $price;
        }
        
        return $new_price;
    }
    
    public function getOptionPriceForOneAttribute()
    {
        $price = $this->getOptionPriceForAttribute();
        $multi = $this->option->multiplier;
        if($multi != null){
            $kg = 10000;
            return ($price/$multi)*$kg;
        }else{
            return $price;
        }
    }
	
	public function getMultiplier() {
        $multiplier = 1;
        $opt = Measure::find()->where(['unit'=> $this->product->ykazatel])->one()->opt;
        if ($opt) {
            if ($this->product->ykazatel) {
                    $multiplier = $this->option->multiplier/10000;
            }
        }
        return $multiplier;
    }
}
