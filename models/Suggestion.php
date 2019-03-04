<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suggestion".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $suggestion_id
 *
 * @property Product $suggestion
 * @property Product $product
 */
class Suggestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'suggestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'suggestion_id'], 'required'],
            [['product_id', 'suggestion_id'], 'integer'],
            [['suggestion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['suggestion_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['suggestion'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'suggestion_id' => 'Suggestion ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestion()
    {
        return $this->hasOne(Product::className(), ['id' => 'suggestion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
	
	    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['product_id' => 'product_id']);
    }
}
