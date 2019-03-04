<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "filter_to_product".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $filter_id
 *
 * @property Filter $filter
 * @property Product $product
 */
class FilterToProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filter_to_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'filter_id'], 'required'],
            [['product_id', 'filter_id'], 'integer'],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filter::className(), 'targetAttribute' => ['filter_id' => 'id']],
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
            'filter_id' => 'Filter ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filter::className(), ['id' => 'filter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
