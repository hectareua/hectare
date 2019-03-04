<?php

namespace app\models;

use Yii;


class Bonuse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bonuse';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['one_title_ru', 'one_title_uk', 'one_content_ru', 'one_content_uk', 'two_title_ru', 'mob_text_title_ru', 'mob_text_title_uk', 'mob_text_ru', 'mob_text_uk', 'two_title_uk', 'two_content_ru', 'two_content_uk', 'three_title_ru', 'three_title_uk', 'three_content_ru', 'three_content_uk', 'four_content_ru', 'four_content_uk'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'one_title_ru' => 'First title RU',
            'one_title_uk' => 'First title UK',
            'one_content_ru' => 'First content RU',
            'one_content_uk' => 'First content UK',
            'mob_text_title_ru' => 'Mobile title RU',
            'mob_text_title_uk' => 'Mobile title UK',
            'mob_text_ru' => 'Mobile content RU',
            'mob_text_uk' => 'Mobile content UK',
            'two_title_ru' => 'Second title RU',
            'two_title_uk' => 'Second title UK',
            'two_content_ru' => 'Second content RU',
            'two_content_uk' => 'Second content UK',
            'three_title_ru' => 'Third title RU',
            'three_title_uk' => 'Third title UK',
            'three_content_ru' => 'Third content RU',
            'three_content_uk' => 'Third content UK',
            'four_content_ru' => 'Fourth content RU',
            'four_content_uk' => 'Fourth content UK',
        ];
    }

}
