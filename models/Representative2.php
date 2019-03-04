<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "representative".
 *
 * @property integer $id
 * @property string $region
 * @property string $address
 * @property string $phones
 * @property string $email
 * @property string $name
 * @property integer $image_id
 * @property string $region_uk
 * @property string $region_ru
 *
 */
class Representative extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'representative';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region', 'address', 'address_uk', 'email', 'name', 'name_uk','city','city_uk'], 'required'],
            [['phones','region_uk','region_ru','city','city_uk'], 'string'],
            [['image_id'],'safe'],    
            [['region', 'address', 'address_uk', 'email', 'name', 'name_uk','schedule'], 'string', 'max' => 255],    
            [['image_id'], 'exist', 'skipOnError' => true,  'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']]  
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'address' => 'Address RU',
            'address_uk' => 'Address UK',
            'phones' => 'Phones',
            'email' => 'Email',
            'name' => 'Name RU',
            'name_uk' => 'Name UK',
            'schedule' => 'Schedule',
            'image_id' => 'Image ID',
            'region_uk' => 'Область укр',
            'region_ru' => 'Область рус',
            'city' => 'Город укр',
            'city_uk' => 'Город рус',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'region',
            'address',
            'address_uk',
            'phones',
            'email',
            'name',
            'name_uk',
            'schedule',
            'image_id',
            'region_ru',
            'region_uk',
            'city',
            'city_uk',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function getStock1c()
    {
        return $this->hasOne(Stock1c::className(), ['representative_id' => 'id']);
    }

    public function getOrder()
    {
        return $this->hasMany(Order::className(), ['representative_id' => 'id']);
    }
}
