<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_tabs".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 */
class InfoTabs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_tabs';
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
            'name_uk' => 'Категорія',
            'name_ru' => 'Name Ru',
        ];
    }

    public function getInfoTabsContent(){
        return $this->hasMany(InfoTabsContent::className(), ['info_tabs_id' => 'id']);
    }
}
