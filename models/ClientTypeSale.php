<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type_sale".
 *
 * @property integer $id
 * @property integer $product_code1c
 * @property string $product_name
 * @property integer $manager_code1c
 * @property string $manager_name
 * @property integer $manufacturer_code1c
 * @property string $manufacturer_name
 * @property integer $qty
 * @property double $sale_sum
 * @property string $sale_date
 * @property string $import_date
 */
class ClientTypeSale extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_type_sale';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qty'], 'integer'],
            [['sale_sum'], 'number'],
            [['sale_date', 'import_date'], 'safe'],
            [['product_code1c', 'manager_code1c', 'manufacturer_code1c'], 'string', 'max' => 15],
            [['product_name', 'manager_name', 'manufacturer_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code1c' => 'Product Code1c',
            'product_name' => 'Product Name',
            'manager_code1c' => 'Manager Code1c',
            'manager_name' => 'Manager Name',
            'manufacturer_code1c' => 'Manufacturer Code1c',
            'manufacturer_name' => 'Manufacturer Name',
            'qty' => 'Qty',
            'sale_sum' => 'Sale Sum',
            'sale_date' => 'Sale Date',
            'import_date' => 'Import Date',
        ];
    }


    public function getManagers()
    {
        return $this->hasOne(Manager::className(), ['code1c' => 'manager_code1c']);
    }

    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['code1c' => 'product_code1c']);
    }

    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['code1c' => 'manufacturer_code1c']);
    }
}
