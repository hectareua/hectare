<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property AttributeOption[] $attributeOptions
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute';
    }

    public static function getDropDownList()
    {
        $result = [];
        $models = self::find()->all();
        foreach ($models as $model)
        {
            $result[$model->id] = $model->name_uk;
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
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
            'name_uk' => 'Назва українською',
            'name_ru' => 'Назва російською',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeOptions()
    {
        return $this->hasMany(AttributeOption::className(), ['attribute_id' => 'id']);
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
