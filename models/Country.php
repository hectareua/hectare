<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $iso3
 * @property string $iso2
 *
 * @property Client[] $clients
 * @property Client[] $clients0
 * @property Order[] $orders
 */
class Country extends \yii\db\ActiveRecord
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
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk', 'name_ru', 'iso3', 'iso2'], 'required'],
            [['name_uk', 'name_ru'], 'string', 'max' => 255],
            [['iso3'], 'string', 'max' => 3],
            [['iso2'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => 'Назва країни українською',
            'name_ru' => 'Назва країни російською',
            'iso3' => 'Трьохсимвольний код країни',
            'iso2' => 'Двохсимвольний код країни',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Client::className(), ['delivery_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients0()
    {
        return $this->hasMany(Client::className(), ['billing_country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_country_id' => 'id']);
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
    
    public static function getDropDownList()
    {
        $result = [];
        $countries = Country::find()->all(); 
        foreach ($countries as $country)
        {
                $result[$country->id] = $country->name_uk;
        }
        return $result;
    }    
}
