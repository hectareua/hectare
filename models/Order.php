<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $client_id
 * @property integer $payment_system_id
 * @property integer $status_id
 * @property string ttn
 * @property string $ordered_at
 * @property string $billing_fullname
 * @property string $billing_city
 * @property string $billing_region
 * @property string $billing_phone
 * @property string $billing_email
 * @property string $delivery_fullname
 * @property string $delivery_address
 * @property string $delivery_city
 * @property string $delivery_region
 * @property integer $delivery_country_id
 * @property string $delivery_phone
 * @property string $comment
 * @property  integer $delivery_type
 *
 * @property Country $deliveryCountry
 * @property Client $client
 * @property PaymentSystem $paymentSystem
 * @property OrderStatus $status
 * @property OrderProduct[] $orderProducts
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    const EVENT_ON_CREATE = 'on-create';
    const EVENT_ON_TTN = 'on-ttn';
    const PAYPARTS_CONFIRMED = 8;
    const PAYPARTS_REJECTED = 10;
    const PAYPARTS_NOT_CONFIRMED = 9;
    const EVENT_UPDATE_STATUS = 11;
    const NEW_ORDER = 1;

    const DELIVERY_TYPE_BY_USER = 0;
    const DELIVERY_TYPE_NEW_POST = 1;
    const DELIVERY_TYPE_TO_HOME = 2;
    const DELIVERY_TYPE_MOMENT_TO_HOME = 3;

    public static $deliveryTypes = [
        self::DELIVERY_TYPE_TO_HOME => 'Доставка додому',
        self::DELIVERY_TYPE_MOMENT_TO_HOME => 'Миттєва доставка додому',
        self::DELIVERY_TYPE_BY_USER => 'Самовивіз',
        self::DELIVERY_TYPE_NEW_POST => 'Нова Пошта',
    ];

    public function init()
    {
        $this->on(self::EVENT_ON_CREATE, [$this, 'sendMail']);
        $this->on(self::EVENT_ON_TTN, [$this, 'sendPushTtn']);
        $this->on(self::EVENT_UPDATE_STATUS, [$this, 'sendPushStatus']);
    }

    public function sendMail()
    {
        $receiverEmail = \app\models\SiteInfo::loadData()->contacts_email;
        if ($receiverEmail)
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'newOrder-html', 'text' => 'newOrder-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Нове замовлення")
                ->send();
    }

    public function sendPushTtn()
    {
        if ($this->ttn && $this->client && $this->client->user)
        {
            $this->client->user->sendPushMessage("Ваше замовлення відправлено. Ви можете переглянути стан замовлення в особистому кабінеті.");
        }
    }
    
    public function sendPushStatus()
    {
        if ($this->status_id && $this->client && $this->client->user)
        {
            $this->client->user->sendPushMessage("Статус доставки замовлення оновлений. Ви можете переглянути стан замовлення в особистому кабінеті.");
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'payment_system_id', 'status_id', 'delivery_country_id', 'delivery_type', 'paid'], 'integer'],
            [['payment_system_id', 'status_id'], 'required'],
            [['ordered_at', 'ttn'], 'safe'],
            [['comment'], 'string'],
            [['billing_fullname', 'billing_city', 'billing_region', 'billing_email', 'delivery_fullname', 'delivery_address', 'delivery_city', 'delivery_region'], 'string', 'max' => 255],
            [['billing_email'], 'email'],
       //     [['billing_phone'], 'string', 'max' => 17],
            [['billing_phone', 'delivery_phone'], 'string', 'max' => 19],
            [['delivery_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['delivery_country_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['payment_system_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentSystem::className(), 'targetAttribute' => ['payment_system_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['status_id' => 'id']],
            [['representative_id'], 'exist', 'skipOnError' => true, 'targetClass' => Representative::className(), 'targetAttribute' => ['representative_id' => 'id']],
			[['sum_part_pay'], 'number'],
		];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'ordered_at',
            'status',
            'ttn',
            'delivery_type',
            'billing_fullname',
            'billing_city',
            'billing_region',
            'billing_phone',
            'billing_email',
            'delivery_fullname',
            'delivery_address',
            'delivery_city',
            'delivery_region',
            'deliveryCountry',
            'delivery_phone',
            'comment',
            'paymentSystem',
            'orderProducts',
            'price',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Користувач',
            'billing_first_name' => 'Ім\'я користувача',
            'payment_system_id' => 'Система сплати',
            'status_id' => 'Статус Замовлення',
            'ttn' => 'ТТН',
            'ordered_at' => 'Дата створення',
            'billing_fullname' => 'Повне ім\'я платника',
            'billing_city' => 'Місто платника',
            'billing_region' => 'Регіон платника',
            'billing_phone' => 'Телефон платника',
            'billing_email' => 'Електронна адреса платника',
            'delivery_type' => 'Тип відправлення',
            'delivery_fullname' => 'Повне ім\'я отримувача',
            'delivery_address' => 'Адреса отримувача',
            'delivery_city' => 'Місто отримувача',
            'delivery_region' => 'Регіон отримувача',
            'delivery_country_id' => 'Країна отримувача',
            'delivery_phone' => 'Телефон отримувача',
            'comment' => 'Коментарі',
            'price' => 'Вартість, грн.',
            'representative_id' => 'Магазин',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDeliveryCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'delivery_country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentSystem()
    {
        return $this->hasOne(PaymentSystem::className(), ['id' => 'payment_system_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->via('orderProducts');
    }

    public function getPrice()
    {
        $price = 0;
        foreach($this->orderProducts as $orderProduct)
        {
            $_price = $orderProduct->amount * $orderProduct->product->realPrice;
            if ($orderProduct->attributeValues)
            {
                foreach ($orderProduct->attributeValues as $attributeValue)
                {
                    $_price = $orderProduct->amount * $attributeValue->realPrice;
                }
            }
            $discount = 1;
            if ($orderProduct->discount)
                $discount = (100-$orderProduct->discount)/100;
            $_price *= $discount;
            $price += $_price;
        }
        return $price;
    }

    public function getRepresentative()
    {
        return $this->hasOne(Representative::className(), ['id' => 'representative_id']);
    }
    
    public function getTypeOfDelivery()
    {
        if($this->delivery_type == 1){
            return "Нова пошта";
        }else{
            return "Самовивіз";
        }
    }
	
	public function getOrderTotalSum($orderId){
        $orderProduct = new \app\models\OrderProduct();
        return $orderProduct->getSumPay($orderId, 1);
    }

}
