<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_bonus".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_bonus_id
 * @property integer $price
 * @property string $ordered_at
 *
 * @property User $user
 * @property ProductBonus $productBonus
 */
class OrderBonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_bonus_id', 'price'], 'integer'],
            [['ordered_at'], 'required'],
            [['ordered_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_bonus_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductBonus::className(), 'targetAttribute' => ['product_bonus_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Кліент',
            'product_bonus_id' => 'Товар',
            'price' => 'Ціна',
            'ordered_at' => 'Замовлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductBonus()
    {
        return $this->hasOne(ProductBonus::className(), ['id' => 'product_bonus_id']);
    }
}
