<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property DepartmentRating[] $departmentRatings
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => 'Name Uk',
            'name_ru' => 'Name Ru',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentRatings()
    {
        return $this->hasMany(DepartmentRating::className(), ['depart_id' => 'id']);
    }
}
