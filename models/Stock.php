<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
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
class Stock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['avid'], 'required'],
            [['stockid','product_id'], 'integer'],
            [['main','franch','stock'], 'number'],
         //   [['avid'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['avid' => 'id']],
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
            'avid' => 'Option ID',
            'stockid' => 'stockid',
            'main' => 'main',
            'franch' => 'franch',
            'stock' => 'stock',
        ];
    }

	public static function isOnStock($avid,$stockid) {
		$ret = ['code'=>10,'info'=>'Error'];
		$res = Stock::findOne(['avid'=>$avid,'stockid'=>$stockid]);
		if ($res) {
			$ret = ['code'=>200,'info'=>$res];
		} else {
			$ret = ['code'=>404,'info'=>''];
		}
		return $ret;
	}

	public static function saveToStock($product_id,$avid,$stockid,$amount) {
		$ret = ['code'=>10,'info'=>'Error'];
		$res = Stock::findOne(['avid'=>$avid,'stockid'=>$stockid]);
		if ($res) {
			$st->avid = $name;
			$st->product_id = $product_id;
			$st->stockid = $stockid;
			$st->amount = $amount;
			$res = $st->update();	
			$ret = ['code'=>200,'info'=>$res];
		} else {
			$st = new Stock();
			$st->avid = $name;
			$st->product_id = $product_id;
			$st->stockid = $stockid;
			$st->amount = $amount;
			
			$res = $st->save();
			$ret = ['code'=>404,'info'=>$res];
		}
		return $ret;
	}
	

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAv()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'avid']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     * /
    public function getOption()
    {
        return $this->hasOne(AttributeOption::className(), ['id' => 'option_id']);
    }
*/
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'avid']);
    }

    public function getStock1c()
    {
        return $this->hasOne(Stock1c::className(), ['id' => 'stockid']);
    }
	
	    public function getSuggestion()
    {
        return $this->hasMany(Suggestion::className(), ['product_id' => 'product_id']);
    }
	public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
