<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forum".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $created_at
 * @property integer $user_id
 * @property integer $views
 * @property string $seo_title_uk
 * @property string $seo_title_ru
 * @property string $seo_keywords_uk
 * @property string $seo_keywords_ru
 * @property string $seo_description_uk
 * @property string $seo_description_ru
 * @property string $slug
 * @property integer $image_id
 * @property string $text
 *
 * @property User $user
 * @property Category $category
 * @property ForumMessage[] $forumMessages
 */
class Forum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forum';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['category_id', 'user_id', 'views', 'image_id'], 'integer'],
            [['created_at'], 'safe'],
            [['seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru','slug'], 'safe'],
            [['name', 'text'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'name',
            'created_at' => function($model){return strtotime($model->created_at);},
            'user',
            'views',
            'messages' => function($model){return count($model->forumMessages);},
            'category_name' => function($model){
                return $model->category
                ?[
                    'uk' => $model->category->name_uk,
                    'ru' => $model->category->name_ru,
                ]
                :[
                    'uk' => 'Без категорії',
                    'ru' => 'Без категории',
                ];},
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва форуму',
            'category_id' => 'Категорія',
            'created_at' => 'Дата створення',
            'user_id' => 'Користувач',
            'views' => 'Кількість переглядів',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'slug' => 'SEO URL',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumMessages()
    {
        return $this->hasMany(ForumMessage::className(), ['forum_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
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
