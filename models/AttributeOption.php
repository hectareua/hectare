<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_option".
 *
 * @property integer $id
 * @property integer $attribute_id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property Attribute $attr
 * @property AttributeValue[] $attributeValues
 */
class AttributeOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_option';
    }

    public static function getDropDownList()
    {
        $result = [];
        $options = self::find()->all();
        foreach ($options as $option)
        {
            if (empty($result[$option->attr->name_uk]))
                $result[$option->attr->name_uk] = [];
            $result[$option->attr->name_uk][$option->id] = $option->attr->name_uk . ' - ' . $option->name_uk;
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'name_uk', 'name_ru', 'multiplier'], 'required'],
            [['attribute_id'], 'integer'],
            [['multiplier'], 'integer'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'attr',
            'name_uk',
            'name_ru',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Атрибут',
            'name_uk' => 'Назва українською',
            'name_ru' => 'Назва російською',
        ];
    }

    /**
     * NOTE: getAttribute is taken by Yii :(
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['option_id' => 'id']);
    }

    public function getName()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->name_ru;
        case 'uk':
        default:
            return $this->name_uk;
        }
    }
}
