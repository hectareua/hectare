<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product1c".

 */
class Product1c extends \yii\db\ActiveRecord
{
    public $cnt; //for aggregation
    public $filters; //for adding filters
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product1c';
    }

    public function init()
    {
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid','av'], 'integer'],
            [['pid'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['pid' => 'id']],
            [['av'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['av' => 'id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'pid',
            'av',
            'comment',
            '1cfull',
            '1c'
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
       /*     'description_uk' => function($model){return strip_tags($model->description_uk, '<p><b><i><ul><li><br>');},
            'description_ru' => function($model){return strip_tags($model->description_ru, '<p><b><i><ul><li><br>');},
            'suggestedProducts',
            'alsobuyProducts',
            'reviews' => function($product)
            {
                $reviews = [];
                foreach ($product->reviews as $review)
                {
                    if (!$review->is_visible) continue;
                    $reviews[] = $review->getSafeFields();
                }
                return $reviews;
            },
            'fieldValues',
            'attributeValues',
            'image' => function($product) {
              $images = $product->images;
              if (sizeof($images) === 0) return '';
              return $images[0]->url;
            } */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
     /*       'id' => 'ID',
            'category_id' => 'Категорія',
            'manufacturer_id' => 'Виробник',
            'dv' => 'Действующее вещество',
            'dv_uk' => 'Діюча речовина',
            'name_uk' => 'Назва українською',
            'name_ru' => 'Назва російською',
            'updated_at'=> 'Updated At',
            'description_uk' => 'Опис українською',
            'description_ru' => 'Опис російською',
            'currency_id' => 'Валюта',
            'ykazatel' => 'Указатель',
            'price' => 'Вартість',
            'opt'=>'Кількість товару для оптової ціни',
            'opt_uk'=>'Оптова ціна',
               'opt1'=>'Кількість товару для оптової ціни 2',
            'opt_uk1'=>'Оптова ціна 2',
            'discount' => 'Знижка (%)',
            'discount_till' => 'Знижка діє до',
            'is_in_stock' => 'Чи є в наявності',
            'is_new' => 'Чи новий товар',
            'is_over' => 'Закінчується',
            'price_specify' => 'Ціну уточнювати',
            'is_suspended' => 'Призупинено продаж',
            'is_on_sale' => 'Наявність розпродажу',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'seo_header_uk' => 'SEO H1 українською',
            'seo_header_ru' => 'SEO H1 російською',
            'slug' => 'SEO URL',
            'order' => 'Порядковий номер',
            'filters' => 'Фільтр',
            'super' => 'Суперціна',
            'topsale' => 'Топ продаж',
            'bonus' => 'Бонус' */
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'av']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'pid']);
    }
}
