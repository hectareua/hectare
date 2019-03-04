<?php

namespace app\models;

use Yii;

class CartItem extends \yii\base\Model
{
    const BUY = 0;
    const CREDIT = 1;    

    public $product_id = null;
    public $amount = null;
    public $bonusUsed = 0;

    public $attrs = [];

    protected $_product = null;
    protected $_order = null;
    protected $_attributeValues = [];

    public function getProduct()
    {
        if (empty($this->_product))
            $this->_product = Product::findOne($this->product_id);
        return $this->_product;
    }

    public function getAttributeValues()
    {
        if (!$this->attrs)
            return [];
        if (!$this->_attributeValues)
        {
            foreach ($this->attrs as $attribute_id => $attribute_value_id) {
                $this->_attributeValues[$attribute_id] = AttributeValue::findOne($attribute_value_id);
            }
        }
        return $this->_attributeValues;
    }

    public function getPrice() {

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

    public function getOptPrice() {

        return $this->product->optCurrencyPrice;
    }

    public function getOptPrice1() {
        return $this->product->optCurrencyPrice1;
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

    public function getYkazatel() {
        return $this->product->ykazatel;
    }

    public static function getAllBonuses($userId = false)
    {
        if (!$userId) $userId = Yii::$app->user->id;
        $client = Client::find()->where(['user_id' => $userId])->one();
        if ($client) {
            $result = Yii::$app->getDb()
                ->createCommand('SELECT SUM(bonus_got) as bonus_plus, SUM(bonus_write_off) as bonus_minus
                                 FROM `order`
                                 WHERE client_id=:client_id OR ( billing_phone=:billing_phone AND ISNULL(client_id) )',
                    [':client_id' => $client->id, ':billing_phone' => $client->billing_phone])
                ->queryOne();
            return $result['bonus_plus'] - $result['bonus_minus'];
        } else {
            return false;
        }
    }

    public static function existsBonusRequest()
    {
        $client = Client::find()->where(['user_id' => Yii::$app->user->id])->one();
        if ($client) {
        $result = Yii::$app->getDb()
            ->createCommand('SELECT bonus_write_off_request, bonus_write_off
                                 FROM `order`
                                 WHERE client_id=:client_id  OR ( billing_phone=:billing_phone AND ISNULL(client_id) )',
                [':client_id' => $client->id, ':billing_phone' => $client->billing_phone])
            ->queryAll();

        $flag = true;

        foreach ($result as $order) {
            if (($order['bonus_write_off_request'] == 0 && $order['bonus_write_off'] == 0)
                || ($order['bonus_write_off_request'] >= 0 && $order['bonus_write_off'] > 0)
            ) {
                $flag = false;
            } else {
                $flag = true;
            }
        }
        } else {
            return false;
        }

        return $flag;

    }

    public function checkInComplects($discountReset) {

		if ($this->attrs) {
		//	$sc = explode(',',Yii::$app->session['complects']);
			$sc = explode(',',$_COOKIE['complects']);
			setcookie('complects1', implode(',',$sc), time() + (86400 * 30), "/");
			$discount = $discountReset;
			foreach ($sc as $c) {
				$comp = ComplectsProduct::find()->where("`complectid` ='". $c ."' AND `attributeid` = '".$this->attrs[1]."'")->one();
				setcookie('complects2', json_encode($this->attrs[1]), time() + (86400 * 30), "/");
				setcookie('complects3', json_encode($comp), time() + (86400 * 30), "/");

				if (($comp) && ($comp->discount > $discount)) {
					$discount = $comp->discount;
				}
			}
		}
        return (1-$discount/100);
	}
/*
    public function getComplectsDiscount($complectid) {
		
		if ($this->attributeValues) {
			$comp = ComplectsProduct::find()->where("`complectid` ='". $complectid ."' AND `attributeid` = '".$this->attributeValues[0]."'")->one();
			if ($comp) {
				return (1-$comp->discount/100);
			}
		}
        return 1.0;
	}
	*/
    public function getTotalPrice()
    {
        /* $opt = Measure::find()->where(['unit'=> $this->product->ykazatel])->one()->opt;
        if ($opt) {

            foreach ($this->attributeValues as $attributeValue) {
                $multiplier = $attributeValue->option->multiplier/10000;
            }

            $return = $this->price * $this->amount - $this->bonusUsed;


            if ($this->product->opt <= $this->amount * $multiplier) {
                $return = $this->optPrice * $this->amount * $multiplier - $this->bonusUsed;
            }

            if ($this->product->opt1 <= $this->amount * $multiplier) {
                $return = $this->optPrice1 * $this->amount * $multiplier - $this->bonusUsed;
            }



            return $return; //
        }*/
        return $this->price * $this->checkInComplects(0) * $this->amount - $this->bonusUsed;
     //   return $this->price * $_COOKIE['complects']/3 * $this->amount - $this->bonusUsed;
    }
}
