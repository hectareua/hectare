<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "availability_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_ua
 *
 */
class AvailabilityStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'availability_status';
    }

    public static function getDropDownList()
    {
        $result = [];
        $options = self::find()->all();
        foreach ($options as $option)
        {
            if (empty($result[$option->name_ua]))
              //  $result[$option->name_ua] = [];
            $result[$option->id] = $option->name_ua;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'name_ua'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'name',
            'name_ua',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва російською',
            'name_ua' => 'Назва українською',
        ];
    }

    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['status' => 'id']);
    }

    public function getName()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->name;
            case 'uk':
            default:
                return $this->name_ua;
        }
    }
}
