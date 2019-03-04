<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property double $rate
 *
 * @property Product[] $products
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return ['id', 'code', 'rate'];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва валюти',
            'code' => 'Код валюти',
            'rate' => 'Курс',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['currency_id' => 'id']);
    }
}
