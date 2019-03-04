<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "slide".
 *
 * @property integer $id
 * @property string $description_uk
 * @property string $description_ru
 * @property string $link
 * @property integer $image_id
 *
 * @property Image $image
 */
class Slide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description_uk', 'description_ru', 'link_ru', 'link_uk'], 'string'],
            [['image_id_ru', 'image_id_uk'], 'required'],
            [['image_id_ru', 'image_id_uk'], 'integer'],
            [['image_id_uk'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id_uk' => 'id']],
            [['image_id_ru'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id_ru' => 'id']],
			[['img_id_desk_uk'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['img_id_desk_uk' => 'id']],
            [['img_id_desk_ru'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['img_id_desk_ru' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description_uk' => 'Опис українською',
            'description_ru' => 'Опис російською',
            'link_uk' => 'Посилання для українського сайту',
            'link_ru' => 'Посилання для російського сайту',
        ];
    }
    
    public function fields()
    {
        return [
            'id',
            'image_id_uk',
            'image_id_ru',
            'link_uk',
            'link_ru',
            'imageru',
            'imageuk'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {

        switch (Yii::$app->language)
        {
            case 'ru':
                $imageId = 'image_id_ru';
                break;
            case 'uk':
                $imageId = 'image_id_uk';
                break;
            default:
                $imageId = 'image_id_uk';
        }
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }
	
	public function getImageDesk()
    {
        switch (Yii::$app->language)
        {
            case 'ru':
                $imageId = 'img_id_desk_ru';
                break;
            case 'uk':
                $imageId = 'img_id_desk_uk';
                break;
            default:
                $imageId = 'img_id_desk_uk';
        }
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }

    public function getImageru()
    {
        $imageId = 'image_id_ru';
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }

    public function getImageuk()
    {
        $imageId = 'image_id_uk';
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }
	
	 public function getImageDeskRu()
    {
        $imageId = 'img_id_desk_ru';
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }

    public function getImageDeskUk()
    {
        $imageId = 'img_id_desk_uk';
        return $this->hasOne(Image::className(), ['id' => $imageId]);
    }

    public function getDescription()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->description_ru;
            case 'uk':
            default:
                return $this->description_uk;
        }
    }

    public function getLink()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->link_ru;
            case 'uk':
            default:
                return $this->link_uk;
        }
    }
}
