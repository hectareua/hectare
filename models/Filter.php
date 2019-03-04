<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "filter".
 *
 * @property integer $id
 * @property integer $filter_id
 * @property string $name_uk
 * @property string $name_ru
 *
 * @property Filter $filter
 * @property Filter[] $filters
 * @property FilterToProduct[] $filterToProducts
 */
class Filter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk', 'name_ru'], 'required'],
            [['filter_id'], 'integer'],
            [['filter_id'], 'safe'],
            [['description_uk','description_ru'], 'string'],
            [['name_uk', 'name_ru','seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru','seo_header_uk', 'seo_header_ru'], 'string', 'max' => 255],
            [['filter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Filter::className(), 'targetAttribute' => ['filter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_filter' => 'Батьківський фільтр',
            'name_uk' => 'Назва фільтру українською',
            'name_ru' => 'Назва фільтру російською',
            'filters' => 'Батьківський фільтр',
            'filter_id' => 'Батьківський фільтр',
            'description_uk' => 'Опис українською',
            'description_ru' => 'Опис російською',
            'filter.name_uk' => 'Батьківський фільтр',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'seo_header_uk' => 'SEO H1 українською',
            'seo_header_ru' => 'SEO H1 російською',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilter()
    {
        return $this->hasOne(Filter::className(), ['id' => 'filter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilters()
    {
        return $this->hasMany(Filter::className(), ['filter_id' => 'id']);
    }
    
    public function getName() {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->name_ru;
        case 'uk':
        default:
            return $this->name_uk;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilterToProducts()
    {
        return $this->hasMany(FilterToProduct::className(), ['filter_id' => 'id']);
    }
    
    public function getProducts() {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->via('filterToProducts');
    }
    
    public function getParentFilters() {
        $parentFilters[0] = 'без батьківської';
        foreach (Filter::find()->where(['filter_id' => null])->all() as $parentFilter) {
            $parentFilters[$parentFilter->id] = $parentFilter->name_uk;
        }
        return $parentFilters;
    }
        
    public function getAllFilters() {
        $parentFilters = Filter::find()->where(['filter_id' => null])->all();
        $result = [];
        foreach ($parentFilters as $parentFilter) {
            foreach ($parentFilter->filters as $childFilter) {
                $result[$parentFilter->name_uk][$childFilter->id] = $childFilter->name_uk;
            }
        }
        return $result;
    }
}
