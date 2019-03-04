<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "advertising".
 *
 * @property integer $id
 * @property string $text_uk
 * @property string $text_ru
 */
class Advertising extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advertising';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_uk', 'text_ru'], 'safe'],
            [['text_uk', 'text_ru'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_uk' => 'Реклама Укр',
            'text_ru' => 'Реклама Рос',
        ];
    }
}
