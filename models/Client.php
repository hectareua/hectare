<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $billing_first_name
 * @property string $billing_last_name
 * @property string $billing_middle_name
 * @property string $billing_address
 * @property string $billing_city
 * @property string $billing_postcode
 * @property string $billing_region
 * @property integer $billing_country_id
 * @property string $billing_phone
 * @property integer $delivery_differs
 * @property string $delivery_first_name
 * @property string $delivery_last_name
 * @property string $delivery_middle_name
 * @property string $delivery_address
 * @property string $delivery_city
 * @property string $delivery_postcode
 * @property string $delivery_region
 * @property integer $delivery_country_id
 * @property string $delivery_phone
 *
 * @property Country $deliveryCountry
 * @property Country $billingCountry
 * @property User $user
 * @property Order[] $orders
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'billing_country_id', 'delivery_country_id', 'delivery_differs'], 'integer'],
            [['billing_address', 'delivery_address'], 'string'],
            [['billing_first_name', 'billing_last_name', 'billing_middle_name', 'billing_city', 'billing_postcode', 'billing_region', 'delivery_first_name', 'delivery_last_name', 'delivery_middle_name', 'delivery_city', 'delivery_postcode', 'delivery_region'], 'string', 'max' => 255],
            [['billing_phone', 'delivery_phone'], 'string', 'max' => 17],
            [['delivery_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['delivery_country_id' => 'id']],
            [['billing_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['billing_country_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'billing_first_name',
            'billing_last_name',
            'billing_middle_name',
            'billing_address',
            'billing_city',
            'billing_postcode',
            'billing_region',
            'billing_country_id',
            'billing_phone',
            'delivery_first_name',
            'delivery_last_name',
            'delivery_middle_name',
            'delivery_address',
            'delivery_city',
            'delivery_postcode',
            'delivery_region',
            'delivery_country_id',
            'delivery_phone',
            'orders',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'billing_first_name' => 'Billing First Name',
            'billing_last_name' => 'Billing Last Name',
            'billing_middle_name' => 'Billing Middle Name',
            'billing_address' => 'Billing Address',
            'billing_city' => 'Billing City',
            'billing_postcode' => 'Billing Postcode',
            'billing_region' => 'Billing Region',
            'billing_country_id' => 'Billing Country ID',
            'billing_phone' => 'Billing Phone',
            'delivery_differs' => 'Delivery Differs',
            'delivery_first_name' => 'Delivery First Name',
            'delivery_last_name' => 'Delivery Last Name',
            'delivery_middle_name' => 'Delivery Middle Name',
            'delivery_address' => 'Delivery Address',
            'delivery_city' => 'Delivery City',
            'delivery_postcode' => 'Delivery Postcode',
            'delivery_region' => 'Delivery Region',
            'delivery_country_id' => 'Delivery Country ID',
            'delivery_phone' => 'Delivery Phone',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'delivery_country_id']);
    }

    public function getCountries()
    {
        return ArrayHelper::map(Country::find()->all(), 'id', 'name_uk');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillingCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'billing_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['client_id' => 'id']);
    }

    public function getOrdersViaPhone()
    {
        return $this->hasMany(Order::className(), ['billing_phone' => 'billing_phone'])->andWhere('ISNULL(client_id)');
    }

    public function getBillingFullName()
    {
        return trim($this->billing_last_name . ' ' . $this->billing_first_name . ' ' . $this->billing_middle_name);
    }

    public function getDeliveryFullName()
    {
        return trim($this->delivery_last_name . ' ' . $this->delivery_first_name . ' ' . $this->delivery_middle_name);
    }
}
