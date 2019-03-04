<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credit".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $desk_ru
 * @property string $desk_uk
 * @property string $img
 */
class Credit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'credit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk', 'name_ru', 'desk_ru', 'desk_uk'], 'required'],
            [['desk_ru', 'desk_uk'], 'string'],
            [['parent_id','period'], 'string'],
            [['credit_percent'], 'double'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 512],
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
            'desk_ru' => 'Desk Ru',
            'desk_uk' => 'Desk Uk',
            'img' => 'Img',
            'credit_percent' => 'Credit Percent',
            'period' => 'Period',
        ];
    }

      public function getParent()
    {
        return $this->hasMany(Credit::className(), ['id' => 'prarent_id']);
    }
}
