<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_slider".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $link_uk
 * @property string $title_uk
 * @property string $desc_uk
 */
class InfoSlider extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'required'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['link_uk', 'desc_uk'], 'string', 'max' => 255],
            [['title_uk'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'link_uk' => 'URL на статтю, випуск ...',
            'title_uk' => 'Заголовок',
            'desc_uk' => 'Опис',
        ];
    }

    public function getImage(){
        return $this->hasOne(Image::className(),['id' => 'image_id']);
    }
}
