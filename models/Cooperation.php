<?php

namespace app\models;

use Yii;


class Cooperation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cooperation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_uk','text_ru'], 'string'],
            [['text_uk','text_ru'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text_uk' => 'text UK',
            'text_ru' => 'text RU',
        ];
    }

}
