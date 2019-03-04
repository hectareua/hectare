<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_value".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $option_id
 *
 * @property FieldOption $option
 * @property Product $product
 */
class FieldValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'option_id'], 'required'],
            [['product_id', 'option_id'], 'integer'],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => FieldOption::className(), 'targetAttribute' => ['option_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOption()
    {
        return $this->hasOne(FieldOption::className(), ['id' => 'option_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
