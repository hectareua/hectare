<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $amount
 * @property integer $discount
 *
 * @property Product $product
 * @property Order $order
 * @property OrderProductAttributeValue[] $orderProductAttributeValues
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id', 'amount','status'], 'integer'],
            [['discount', 'price1c','price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'amount',
            'product',
            'attributeValues'
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'order',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProductAttributeValues()
    {
        return $this->hasMany(OrderProductAttributeValue::className(), ['order_product_id' => 'id']);
    }

    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['id' => 'attribute_value_id'])->via('orderProductAttributeValues');
    }
	
	public function getOrderPrice() {

        return $this->pricePerBaseMeasure * $this->multiplier;
    }
	
	public function getMultiplier() {

        $multiplier = 1;
        $opt = Measure::find()->where(['unit'=> $this->product->ykazatel])->one()->opt;

        if ($opt) {
            if ($this->product->ykazatel) {
                foreach ($this->attributeValues as $attributeValue) {
                    $multiplier = $attributeValue->option->multiplier/10000;
                }
            }
        }

        return $multiplier;
    }
	
	public function getSumPay($orderId,$paid){
        $result = 0;
        $check = '';
        $product = OrderProduct::find()->where(['order_id' => $orderId])->all();

        foreach ($product as $model) {
            foreach ($model->attributeValues as $priceAttr) {

                    $check = $model->amount * $priceAttr->currencyPrice * $model->multiplier;
                    $result += $model->amount * ($model->price1c ? $model->price1c * $model->multiplier : $priceAttr->currencyPrice * $model->multiplier);

            }

            if (!$check) {
                $array = $model->product->attributeValues;

                if(is_array($array)){
                    foreach ($array as $priceAttr) {

                        $result += $priceAttr->product->orderPayPrice($model->amount, $model->price1c);

                    }
                }else{
                    $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one();
                    if ($price) {
                        $result += $price->orderPayPrice($model->amount,$price->currencyPriceForAttribute);
                    }
                }
            }

        }

        return $result;
    }

    public function getTotalSumPay($userId)
    {
        $result = 0;
        $check = '';
        $client = Client::find()->where(['user_id' => $userId])->one();
        $product = Order::find()->where(['and', ['client_id' => $client->id], ['status_id' => 7]])->all();

        foreach ($product as $orderProduct) {
            if($orderProduct->paid == 3 || $orderProduct->paid == 2) {
                foreach ($orderProduct->orderProducts as $model) {
                    foreach ($model->attributeValues as $priceAttr) {

                        $check = $model->amount * $priceAttr->currencyPrice * $model->multiplier;
                        $result += $model->amount *($model->price1c ? $model->price1c * $model->multiplier : $priceAttr->currencyPrice * $model->multiplier);

                    }
                    if (!$check) {
                        $array = $model->product->attributeValues;
                            if(is_array($array)){
                                foreach ($model->product->attributeValues as $priceAttr) {

                                    $result += $priceAttr->product->orderPayPrice($model->amount, $model->price1c);

                                }
                            }else{
                                $price = \app\models\Product::find()->orWhere(['status' => 1])->andWhere(['id' => $model->product_id])->one();
                                if ($price) {
                                    $result += $price->orderPayPrice($model->amount,$price->currencyPriceForAttribute);
                                }
                            }
                    }

                }
            }if($orderProduct->paid == 2){
                $result -= $orderProduct->sum_part_pay;
            }
        }
            return $result;

    }
	
	public function getPricePerBaseMeasure() {
        if ($this->attributeValues) {
            $opt = Measure::find()->where(['unit'=> $this->product->ykazatel])->one()->opt;

            foreach ($this->attributeValues as $attributeValue) {
                $multiplier = 1;

                if ($opt) {
                    $multiplier = $attributeValue->option->multiplier/10000;;
                }

                $price = $attributeValue->currencyPrice;
                $attribute_opt = $attributeValue->currencyOptPrice;
                $attribute_opt1 = $attributeValue->currencyOptPrice1;


                if ($attributeValue->opt){
                    if ($attributeValue->opt <= $this->amount * $multiplier) {
                        if ($this->amount * $multiplier * $attribute_opt < $this->amount * $multiplier * $price) {
                            $price  = $attribute_opt;
                        }
                    }
                }

                if ($attributeValue->opt1){
                    if ($attributeValue->opt1 <= $this->amount * $multiplier) {
                        if ($this->amount * $multiplier * $attribute_opt1 < $this->amount * $multiplier * $price) {
                            $price = $attribute_opt1;
                        }
                    }
                }

                return $price;
            }
        }
        return $this->product->currencyPrice;
    }
	
}
