<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alsobuy".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $alsobuy_id
 *
 * @property Product $alsobuy
 * @property Product $product
 */
class Alsobuy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alsobuy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'alsobuy_id'], 'required'],
            [['product_id', 'alsobuy_id'], 'integer'],
            [['alsobuy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['alsobuy_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['alsobuy'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'alsobuy_id' => 'Alsobuy ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlsobuy()
    {
        return $this->hasOne(Product::className(), ['id' => 'alsobuy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
