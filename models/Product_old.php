<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $discount
 * @property integer $order
 * @property integer $category_id
 * @property integer $manufacturer_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $description_uk
 * @property string $description_ru
 * @property integer $currency_id
 * @property string $price
 * @property integer $is_in_stock
 * @property integer $is_new
 * @property integer $is_on_sale
 * @property string $seo_title_uk
 * @property string $seo_title_ru
 * @property string $seo_header_uk
 * @property string $seo_header_ru
 * @property string $seo_keywords_uk
 * @property string $seo_keywords_ru
 * @property string $seo_description_uk
 * @property string $seo_description_ru
 * @property string $slug
 * @property integer $rating
 * @property integer $bestRating
 *
 * @property AttributeValue[] $attributeValues
 * @property FieldValue[] $fieldValues
 * @property OrderProduct[] $orderProducts
 * @property Currency $currency
 * @property Category $category
 * @property Manufacturer $manufacturer
 * @property ProductImage[] $productImages
 * @property Image[] $images
 * @property ProductQuestion[] $productQuestions
 * @property Review[] $reviews
 * @property Suggestion[] $suggestions
 * @property Alsobuy[] $alsobuy
 * @property Product[] $suggestedProducts
 */
class Product extends \yii\db\ActiveRecord
{
    public $cnt; //for aggregation
    public $filters; //for adding filters
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }


    const EVENT_ON_CREATE = 'on-create';
    const EVENT_ON_DISCOUNT = 'on-discount';

    const ACTIVE = 0;
    const BLOCK = 1;


    public static function find()
    {
        return new ActiveQueryStatusCheck(get_called_class());
    }

    public function init()
    {
        $this->on(self::EVENT_ON_DISCOUNT, [$this, 'sendPushSale']);
    }

    public function sendPushNewProduct()
    {
         $title = 'Новий продукт';
         $message = $this->getName();
         $route = $this->getRoute();
         User::sendPushMessageToEveryone($route, $title, $message);
    }

    public function sendPushSale()
    {
        if (!$this->discount) return;
        $title = 'Нова акційна пропозиція';
        $message = $this->getName() . ". " . "Знижка $this->discount%";
        $route = $this->getRoute();
        User::sendPushMessageToEveryone($route, $title, $message);
    }

    private function getRoute() {
        return "product=$this->id";
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'manufacturer_id', 'currency_id', 'is_in_stock', 'is_new', 'is_on_sale', 'status', 'delivery', 'super', 'topsale'], 'integer'],
            [['updated_at'], 'safe'],
            [['name_uk', 'name_ru', 'currency_id', 'price'], 'required'],
            [['description_uk', 'description_ru','ykazatel','opt','opt_uk','opt1','opt_uk1','dv','dv_uk'], 'string'],
            [['seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru', 'seo_header_uk', 'seo_header_ru', 'slug', 'filters'], 'safe'],
            [['price', 'order'], 'number'],
            [['discount_till'], 'date', 'format' => 'yyyy-mm-dd'],
            [['discount'], 'integer', 'min' => 1, 'max' => 99],
            [['name_uk', 'name_ru','dv'], 'string', 'max' => 255],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            ['bonus', 'integer', 'max' => 9999]
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'category_id',
            'manufacturer',
            'manufacturer_name' => function($model){return $model->manufacturer?$model->manufacturer->name:null;},
            'name_uk',
            'name_ru',
            'images',
            'opt','dv','dv_uk',
            'opt_uk',
            'opt1',
            'opt_uk1',
            'currencyPrice' => function($product) {
              return round($product->currencyPrice, 2);
            },
            'updated_at',
            'ykazatel',
            'currencyOldPrice',
            'is_in_stock',
            'is_new',
            'bonus',
            'super',
            'topsale',
            'delivery'
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'description_uk' => function($model){return strip_tags($model->description_uk, '<p><b><i><ul><li><br>');},
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
            }
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
            'bonus' => 'Бонус'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldValues()
    {
        return $this->hasMany(FieldValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
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
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductQuestions()
    {
        return $this->hasMany(ProductQuestion::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->via('productImages');
    }

    public function getImage()
    {
        $images = $this->images;
        if (!$images)
            return null;
        return $images[0];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id'])->where(['is_visible' => 1])->average('rating');
    }

    /**
     * @return mixed
     */
    public function getBestRating()
    {
        return $this->hasMany(Review::className(), ['product_id' => 'id'])->where(['is_visible' => 1])->max('rating');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestions()
    {
        return $this->hasMany(Suggestion::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestedProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'suggestion_id'])
            ->via('suggestions');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlsobuy()
    {
        return $this->hasMany(Alsobuy::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlsobuyProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'alsobuy_id'])
            ->via('alsobuy');
    }

    /**
     * @return float
     */
    public function getCurrencyPrice()
    {
        $price = (float)$this->price;
        if ($price)
        {
            $price = $this->_convertPrice($price) * $this->getDiscountRate();
        }
        return $price;
    }

    /**
     * @return float
     */
    public function getOptCurrencyPrice()
    {
        $price = (float)$this->opt_uk;
        if ($price)
        {
            $price = $this->_convertPrice($price) * $this->getDiscountRate();
        }
        return $price;
    }

    public function getOptCurrencyRealPrice()
    {
        $price = (float)$this->opt_uk;
        if ($price)
        {
            $price = $this->_convertPrice($price);
        }
        return $price;
    }

    public function getOptCurrencyPrice1()
    {
        $price = (float)$this->opt_uk1;
        if ($price)
        {
            $price = $this->_convertPrice($price) * $this->getDiscountRate();
        }
        return $price;
    }

    public function getOptCurrencyRealPrice1()
    {
        $price = (float)$this->opt_uk1;
        if ($price)
        {
            $price = $this->_convertPrice($price);
        }
        return $price;
    }

    /**
     * @return float
     */
    public function getCurrencyOldPrice()
    {
        if ($this->getDiscountRate() === 1.0)
            return 0.0;

        return $this->realPrice;
    }

    /**
     * @return float
     */
    public function getRealPrice()
    {
        $price = (float)$this->price;
        if ($price)
        {
            $price = $this->_convertPrice($price);
        }
        return $price;
    }

    /**
     * @return float
     */
    public function getComplectRate($complect_id,$attribute_id)
    {
		$discount = ComplectsProduct::find()->where("`complectid` = '".$complect_id."' AND `attributeid`='".$attribute_id."'")->one()->discount;
        if ($discount)
            return ((100 - $discount)/100);
        return 1.0;
    }

    /**
     * @return float
     */
    public function getDiscountRate()
    {
        if ($this->discount && (!$this->discount_till || strtotime($this->discount_till) > time()))
            return ((100 - $this->discount)/100);
        return 1.0;
    }

    public function getDiscountDaysLeft()
    {
        if (!$this->discount_till)
            return false;

        $dStart = new \DateTime();
        $dEnd  = new \DateTime($this->discount_till);
        $dDiff = $dStart->diff($dEnd);
        return $dDiff->days+1;
    }

    /**
     * @return float
     */
    protected function _convertPrice($price)
    {
        return round($this->currency->rate * $price, 2);
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
    public function getDvvalue()
    {
        switch(Yii::$app->language)
        {
        case 'ru':
            return $this->dv;
        case 'uk':
        default:
            return $this->dv_uk;
        }
    }


    public function getDescription()
    {
        //return $this->{'description_' . Yii::$app->language};
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

    public function orderPrice ($amount) {

        $_price = $amount * $this->realPrice;

        if ($this->attributeValues)
        {

            $opt = Measure::find()->where(['unit'=> $this->ykazatel])->one()->opt;


            foreach ($this->attributeValues as $attributeValue)
            {

                $multiplier = 1;

                if ($opt) {
                    $multiplier = $attributeValue->option->multiplier/10000;
                }


                $_price = $attributeValue->realPrice * $multiplier;

                if ($attributeValue->opt) {
                    if ($attributeValue->opt <= $amount * $multiplier) {
                        if ($amount * $multiplier * $attributeValue->realOptPrice < $amount * $_price) {
                            $_price  = $attributeValue->realOptPrice * $multiplier;
                        }
                    }
                }

                if ($attributeValue->opt1) {
                    if ($attributeValue->opt1 <= $amount * $multiplier) {
                        if ($amount * $multiplier * $attributeValue->realOpt1Price < $amount * $_price) {
                            $_price = $attributeValue->realOpt1Price * $multiplier;
                        }
                    }
                }

                $_price = $amount * $_price;
            }
        }

        $discount = 1;
        if ($this->discount)
            $discount = (100-$this->discount)/100;
        $_price *= $discount;

        return $_price;
    }

    public function getFilterproduct() {
        return $this->hasMany(FilterToProduct::className(), ['product_id' => 'id']);
    }

    public function getProductFilters() {
        return $this->hasMany(Filter::className(), ['id' => 'filter_id'])->via('filterproduct');
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

    public function getUsage() {
        return $this->hasMany(Touse::className(), ['product_id' => 'id']);
    }
}
