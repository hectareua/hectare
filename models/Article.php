<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $publishing_since
 * @property string $updated_at
 * @property string $publishing_till
 * @property string $title_uk
 * @property string $title_ru
 * @property string $text_uk
 * @property string $text_ru
 * @property integer $image_id
 * @property string $seo_title_uk
 * @property string $seo_title_ru
 * @property string $seo_keywords_uk
 * @property string $seo_keywords_ru
 * @property string $seo_description_uk
 * @property string $seo_description_ru
 * @property string $slug
 *
 * @property string $title
 * @property string $text
 * @property string $seoTitle
 * @property string $seoKeywords
 * @property string $seoDescription
 *
 * @property Image $image
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public static function findPublishedArticles()
    {
        return static::find()
            ->where(['and',
                ['<', 'publishing_since', new Expression('NOW()')],
                ['or',
                    ['publishing_till' => 0],
                    ['>', 'publishing_till', new Expression('NOW()')],
                ],
            ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publishing_since', 'updated_at', 'publishing_till'], 'safe'],
            [['title_uk', 'title_ru', 'text_uk', 'text_ru', 'image_id'], 'required'],
            [['text_uk', 'text_ru', 'seo_keywords_uk', 'seo_keywords_ru', 'seo_description_uk', 'seo_description_ru'], 'string'],
            [['image_id'], 'integer'],
            [['title_uk', 'title_ru', 'seo_title_uk', 'seo_title_ru', 'slug'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    public function fields()
    {
        return [
            'id',
            'title_uk',
            'title_ru',
            'text_uk',
            'text_ru',
            'updated_at',
            'image',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'publishing_since' => 'Дата публікації',
            'updated_at' => 'Дата Обновления',
            'publishing_till' => 'Дата закінчення публікації',
            'title_uk' => 'Заголовок українською',
            'title_ru' => 'Заголовок російською',
            'text_uk' => 'Текст українською',
            'text_ru' => 'Текст російською',
            'image_id' => 'Image ID',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'slug' => 'SEO URL',
        ];
    }

    public function getTitle()
    {
        if (!$this->title_ru)
            return $this->title_uk;
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->title_ru;
            case 'uk':
            default:
                return $this->title_uk;
        }
    }

    public function getText()
    {
        if (!$this->text_ru)
            return $this->text_uk;
        switch(Yii::$app->language)
        {
            case 'ru':
                return $this->text_ru;
            case 'uk':
            default:
                return $this->text_uk;
        }
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
