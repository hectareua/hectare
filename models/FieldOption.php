<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field_option".
 *
 * @property integer $id
 * @property integer $field_id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property Field $field
 * @property FieldValue[] $fieldValues
 */
class FieldOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field_option';
    }

    public static function getDropDownList()
    {
        $result = [];
        $options = self::find()->all();
        foreach ($options as $option)
        {
            if (empty($result[$option->field->name_uk]))
                $result[$option->field->name_uk] = [];
            $result[$option->field->name_uk][$option->id] = $option->field->name_uk . ' - ' .$option->name_uk;
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field_id', 'name_uk', 'name_ru'], 'required'],
            [['field_id'], 'integer'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => Field::className(), 'targetAttribute' => ['field_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'name_uk',
            'name_ru',
            'field',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field_id' => 'Поле',
            'name_uk' => 'Назва українською',
            'name_ru' => 'Назва російською',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldValues()
    {
        return $this->hasMany(FieldValue::className(), ['option_id' => 'id']);
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
