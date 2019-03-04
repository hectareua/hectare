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
 * @property Category $parent
 * @property Category[] $categories
 * @property CategoryField[] $categoryFields
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    
    public static function find()
    {
        return new ActiveQueryStatusCheck(get_called_class());
    }

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
        $categories = Category::findAll(['parent_id' => $category_id]);
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
            [['parent_id', 'image_id', 'order', 'status', 'delivery'], 'integer'],
            [['name_uk', 'name_ru', 'order'], 'required'],
            [['description_uk', 'description_ru'], 'string'],
            [['seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru', 'seo_header_uk', 'seo_header_ru', 'slug'], 'safe'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'delivery',
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
            'delivery' => 'Доставка',
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
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id'])->orderBy(['order'=>SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryFields()
    {
        return $this->hasMany(CategoryField::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
		$return = $this->hasMany(Product::className(), ['category_id' => 'id']);
		return $return;
    }

    public function getSortByRating($limit){
        $products = Yii::$app->db->createCommand('SELECT `product`.*, COUNT(review.id) as comments FROM `product` LEFT JOIN `review` ON review.product_id = product.id WHERE (`product`.`status`=0) AND (`product`.`category_id`=4) GROUP BY(product.id) ORDER BY(comments) DESC LIMIT :limit')
            ->bindValue(':limit', $limit)
            ->queryAll();

        return $products;
    }

	public function getAttributesInPrice($models){
		$m_ids = array();
		$m_prices = array();
		foreach($models as $model){
			$m_ids[] = $model->id;
			$m_prices[] = floatval($model->price);
		}
		$attrs = Yii::$app->db->createCommand('SELECT av.`product_id`, ao.`attribute_id`, av.`price`, av.`id` as value_id, '
			. 'av.`option_id` FROM `attribute_value` AS av LEFT JOIN `attribute_option` AS ao '
			. 'ON(ao.`id`=av.`option_id`) WHERE av.`product_id` IN('.implode(",", $m_ids).') AND av.`price` IN('.implode(",", $m_prices).')'
			. 'GROUP BY av.`product_id`')->queryAll();	
		$_attrs = array();
		
		foreach($attrs as $attr){
			foreach(array('attribute_id','value_id','option_id') as $field){
				$_attrs[$attr['product_id']][$field] = $attr[$field];
			}
		}
		return $_attrs;
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
