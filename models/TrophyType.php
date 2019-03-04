<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trophy_type".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property ManagerTrophy[] $managerTrophies
 */
class TrophyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trophy_type';
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
            'name_uk' => 'Назва укр',
            'name_ru' => 'Назва рос',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagerTrophies()
    {
        return $this->hasMany(ManagerTrophy::className(), ['trophy_type_id' => 'id']);
    }
}
