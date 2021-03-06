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
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            [['stock1','stock2','stock3','stock4'], 'number'],
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
            'stock1' => 'stock1',
            'stock2' => 'stock2',
            'stock3' => 'stock3',
            'stock4' => 'stock4',
        ];
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
