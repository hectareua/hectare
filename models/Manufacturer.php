<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 *
 * @property Product[] $products
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','slug'], 'required'],
            
            [['opps'], 'string'],
            [['name','slug','logo','code1c'], 'string', 'max' => 255],
            [['description_uk','description_ru'], 'string'],
            [['country_id', 'delivery', 'off_partner','exp_roz'], 'integer'],
			[['discount'], 'integer', 'min' => 1, 'max' => 99],
            [['seo_title_uk','seo_title_ru','seo_keywords_uk','seo_keywords_ru','seo_description_uk','seo_description_ru','seo_header_uk', 'seo_header_ru'], 'safe'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва виробника',
            'slug' => 'Аліас виробника',
            'description_uk' => 'Опис українською',
            'description_ru' => 'Опис російською',
            'seo_title_uk' => 'SEO title українською',
            'seo_title_ru' => 'SEO title російською',
            'seo_keywords_uk' => 'SEO keywords українською',
            'seo_keywords_ru' => 'SEO keywords російською',
            'seo_description_uk' => 'SEO description українською',
            'seo_description_ru' => 'SEO description російською',
            'seo_header_uk' => 'SEO H1 українською',
            'seo_header_ru' => 'SEO H1 російською',
            'country_id' => 'Країна',
            'off_partner' => 'Офіційний партнер',
            'logo' => 'Лого виробника',
            'discount' => 'Знижка по виробнику',
			'code1c' => 'Код з 1С',
			'exp_roz' => 'Експорт ROZETKA',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['manufacturer_id' => 'id']);
    }

	/**
	 * @return \yii\db\ActiveQuery
	 */
    public function getTouse()
	{
        return $this->hasMany(Touse::className(), ['id_manufacture' => 'id']);
	}
    

}
