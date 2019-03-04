<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_tabs_content".
 *
 * @property integer $id
 * @property integer $info_tabs_id
 * @property integer $number
 * @property integer $image_id
 * @property string $header_uk
 * @property string $header_ru
 * @property string $desc_uk
 * @property string $desc_ru
 * @property string $author_uk
 * @property string $author_ru
 * @property integer $views
 * @property integer $pdf_url
 */
class InfoTabsContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_tabs_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publishing_date'], 'safe'],
            [['info_tabs_id', 'number', 'image_id', 'image_two_id', 'views', 'main_visible'], 'integer'],
            [['desc_uk', 'desc_ru','text_uk','text_ru','seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru'], 'string'],
            [['header_uk', 'header_ru', 'author_uk', 'author_ru', 'pdf_url','video'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['image_two_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_two_id' => 'id']],
            [['info_tabs_id'], 'exist', 'skipOnError' => true, 'targetClass' => InfoTabs::className(), 'targetAttribute' => ['info_tabs_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publishing_date' => 'Дата опоблікування',
            'info_tabs_id' => 'Категорія',
            'number' => 'Випуск №',
            'image_id' => 'Image ID',
            'image_two_id' => 'Мала картинка',
            'header_uk' => 'Заголовок Укр',
            'header_ru' => 'Заголовок Рос',
            'desc_uk' => 'Опис Укр',
            'desc_ru' => 'Опис Рос',
            'text_uk' => 'Текст Укр',
            'text_ru' => 'Текст Рос',
            'author_uk' => 'Автор Укр',
            'author_ru' => 'Автор Рос',
            'views' => 'Кол-во перег.',
            'pdf_url' => 'Посилання на PDF файл',
            'main_visible' => 'Показати на головній',
            'video' => 'Видео фрейм Youtube: width="1110px" height="640px" ',
        ];
    }


    public function getInfoTabs(){
        return $this->hasOne(InfoTabs::className(), ['id' => 'info_tabs_id']);
    }



    public function getInfoPdfImages()
    {
        return $this->hasMany(InfoPdfImages::className(), ['info_tabs_content_id' => 'id']);
    }

    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function getImageTwo()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_two_id']);
    }

    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->via('infoPdfImages');
    }

    public function getSeoTitle()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->seo_title_ru;
            case 'uk':
            default:
                return $this->seo_title_uk;
        }
    }

    public function getSeoKeywords()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->seo_keywords_ru;
            case 'uk':
            default:
                return $this->seo_keywords_uk;
        }
    }

    public function getSeoDescription()
    {
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->seo_description_ru;
            case 'uk':
            default:
                return $this->seo_description_uk;
        }
    }
}
