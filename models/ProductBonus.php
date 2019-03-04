<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_bonus".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $desc_uk
 * @property string $desc_ru
 * @property integer $price
 *
 * @property OrderBonus[] $orderBonuses
 * @property Image $image
 */
class ProductBonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'name_uk', 'name_ru', 'price'], 'required'],
            [['image_id', 'price','status'], 'integer'],
            [['name_uk', 'name_ru', 'desc_uk', 'desc_ru'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'name_uk' => 'Назва укр',
            'name_ru' => 'Назва рос',
            'desc_uk' => 'Опис укр',
            'desc_ru' => 'Опис рос',
            'status' => 'Статус',
            'price' => 'Ціна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderBonuses()
    {
        return $this->hasMany(OrderBonus::className(), ['product_bonus_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
