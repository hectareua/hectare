<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "save_with_us".
 *
 * @property integer $id
 * @property integer $image_id
 *
 * @property Image $image
 */
class SaveWithUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'save_with_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id','name_uk','name_ru'], 'required'],
            [['image_id'], 'integer'],
            [['name_uk','name_ru','text_uk','text_ru'], 'string'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => 'name UK',
            'name_ru' => 'name RU',
            'text_uk' => 'text UK',
            'text_ru' => 'text RU',
            'image_id' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
