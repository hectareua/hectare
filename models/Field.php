<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "field".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property CategoryField[] $categoryFields
 * @property FieldOption[] $fieldOptions
 * @property Category[] $categories
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field';
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
            [['name_uk', 'name_ru'], 'required'],
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
    public function getCategoryFields()
    {
        return $this->hasMany(CategoryField::className(), ['field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldOptions()
    {
        return $this->hasMany(FieldOption::className(), ['field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->via('categoryFields');
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
