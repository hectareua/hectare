<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $description_uk
 * @property string $description_ru
 * @property string $seo_title_uk
 * @property string $seo_title_ru
 * @property string $seo_keywords_uk
 * @property string $seo_keywords_ru
 * @property string $seo_description_uk
 * @property string $seo_description_ru
 * @property string $slug
 * @property integer $image_id
 * @property integer $order
 *
 * @property Image $image
 * @property Page $parent
 * @property Page[] $categories
 * @property PageField[] $categoryFields
 * @property Product[] $products
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    public static function getDropDownList($ignore_id = null, $category_id = null, $level = 0)
    {
        $result = [];
        $categories = Page::findAll(['parent_id' => $category_id]);
        foreach ($categories as $category)
        {
            if (!($ignore_id && $category->id == $ignore_id))
            {
                $prefix = " ";
                for ($i=0; $i < $level; $i++)
                    $prefix .= "-- ";
                $result[$category->id] = $prefix.$category->name_uk;
                $children = self::getDropDownList($ignore_id, $category->id, $level+1);
                $result += $children;
            }
        }
        return $result;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'image_id', 'order'], 'integer'],
            [['name_uk', 'name_ru', 'order'], 'required'],
            [['description_uk', 'description_ru'], 'string'],
            [['seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru', 'seo_header_uk', 'seo_header_ru', 'slug'], 'safe'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'parent_id',
            'name_uk',
            'name_ru',
            'image',
            'order',
            'categories'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Батьківська категорія',
            'name_uk' => 'Назва категорії українською',
            'name_ru' => 'Назва категорії російською',
            'description_uk' => 'Опис українською',
            'description_ru' => 'Опис російською',
            'image_id' => 'Image ID',
            'order' => 'Послідовність',
            'image' => 'Url зображення',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'seo_header_uk' => 'SEO H1 українською',
            'seo_header_ru' => 'SEO H1 російською',
            'slug' => 'SEO URL',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id'])->orderBy(['order'=>SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryFields()
    {
        return $this->hasMany(PageField::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public function getName()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->name_ru;
        case 'uk':
        default:
            return $this->name_uk;
        }
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
    
    public function getSeoHeader()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->seo_header_ru;
        case 'uk':
        default:
            return $this->seo_header_uk;
        }
    }
}
