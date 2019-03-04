<?php

namespace app\modules\api\controllers;

use app\models\CartItem;
use app\models\Client;
use Yii;
use app\models\Order;
use app\components\parser\ArrayToXML;
use app\models\OrderProduct;
use app\models\OrderProductAttributeValue;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\AttributeValue;

class OrderController extends ApiController
{
	public function actionMake()
	{
		$data = Yii::$app->request->post();
		$productsData = [];
		if (!empty($data['products']))
		{
			foreach ($data['products'] as $productData)
			{
				$productsData[] = [
					'product_id' => $productData['id'],
					'amount' => $productData['quantity'],
					'attribute_value_id' => $productData['attribute_value_id']
				];
			}
			unset($data['products']);
		}
		if (!empty($data['auth_key']))
		{
			$user = User::findOne(['auth_key' => $data['auth_key']]);
			if ($user && $user->client)
			{
				$data['client_id'] = $user->client->id;
				$data['billing_fullname'] = (!empty($user->client->getBillingFullName())) ? ($user->client->getBillingFullName()) : $data['delivery_fullname'];
                $data['billing_city'] = ($user->client->billing_city) ? ($user->client->billing_city) : $data['delivery_city'];
                $data['billing_phone'] = ($user->client->billing_phone) ? ($user->client->billing_phone) : $data['delivery_phone'];
                $data['billing_email'] = $user->email;
			}
			unset($data['auth_key']);
		}
		$transaction = Yii::$app->db->beginTransaction();
		try
		{
			$data['status_id'] = 1;
			$data['ordered_at'] = new \yii\db\Expression('NOW()');
			$order = new Order();
			$order->setAttributes($data);
			if (!$order->save())
			{
				return ['success' => false, 'errors' => $order->getErrors()];
			}
			foreach ($productsData as $productData)
			{
			     $data = [
                    'product_id'=>$productData['product_id'],
                    'amount'=>$productData['amount'],
                ];
                
				$orderProduct = new OrderProduct($data);
				$orderProduct->order_id = $order->id;
				$orderProduct->save();
				
				$orderAttribute = new OrderProductAttributeValue();
                $orderAttribute->attribute_value_id = $productData['attribute_value_id'];
                $orderAttribute->order_product_id = $orderProduct->id;
                $orderAttribute->save();
			}

            $order->trigger(Order::EVENT_ON_CREATE);
			$transaction->commit();
		}
		catch(\Exception $e)
		{
			$transaction->rollBack();
			throw $e;
		}

		return ['success' => true];
	}

	public function actionOrderProduct($auth_key, $order_product_id)
	{
        $this->serializer['expand'] = ['order'];

		if (!$auth_key)
			return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
		$user = User::findOne(['auth_key' => $auth_key]);
		if (!$user || !$user->client)
			return ['success' => false, 'status' => 403, 'error' => 'Access denied'];

		$orderProduct = OrderProduct::findOne($order_product_id);

		return $orderProduct;
	}

	public function actionInfo()
    {
        $data = Yii::$app->request->post();
        $auth_key = $data['auth_key'];
        if (!$auth_key) return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
        $user = User::findOne(['auth_key' => $auth_key]);
        if (!($user && $user->client)) return ['success' => false, 'status' => 400, 'error' => 'unknown user'];
				$client = $user->client;
				return new ActiveDataProvider([
            'pagination' => false,
            'query' => $client->getOrders()
        ]);
    }

    public function actionBonuses() {
        $data = Yii::$app->request->post();
        $auth_key = $data['auth_key'];
        if (!$auth_key) return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
        $user = User::findOne(['auth_key' => $auth_key]);
        if (!($user && $user->client)) return ['success' => false, 'status' => 400, 'error' => 'unknown user'];
	    return CartItem::getAllBonuses($user->id);
    }
	
	public function actionExportOrders() {
        $array = array();
        $data_key = Yii::$app->request->get('key');
		$status = Yii::$app->request->get('status');
        $key = '1cExportOrders_hectare.com.ua';
        $key_md = Yii::$app->getSecurity()->generatePasswordHash($key);
        //echo $key_md;die();
        if (!$data_key || strlen($data_key) < 59) return ['success' => false, 'status' => 400, 'error' => 'data_key is required'];

        if (!(Yii::$app->security->validatePassword($key, $data_key))) return ['success' => false, 'status' => 400, 'error' => 'unknown key'];
			if(Yii::$app->security->validatePassword($key, $data_key) && !$status){
				$orders = Order::find()->
				where(['status_id' => 2])
					->all();

				foreach ($orders as $order){
					$arrayDetails = array();
					$arrayProduct = array();
					foreach ($order->orderProducts as $attr){
						$result = '';
						foreach ($attr->orderProductAttributeValues as $av){
							array_push($arrayProduct,  array(
								"@product_id" => $av->attributeValue->code1c,
								"quantity" => $attr->amount,
								"price" => $av->attributeValue->price
							));
							$arrayDetails = array('product' => $arrayProduct);

							$result = $av->attributeValue->code1c;
						}
						if(!$result) {
							foreach ($attr->product->attributeValues as $attributeValue) {
								array_push($arrayProduct, array(
									"@product_id" => $attributeValue->code1c,
									"quantity" => $attr->amount,
									"price" => $attributeValue->price
								));
								//print_r($attributeValue->code1c);
							}
							$arrayDetails = array('product' => $arrayProduct);

							// $a=false;
						}
					}
					array_push($array, array(
					   "order_id" => $order->id,
						"user_phone" => '+38'.$order->client->billing_phone,
						"ordered_at" => $order->ordered_at,
						"payment_system_id" => $order->payment_system_id,
						"comment" => $order->comment,
						"status_id" => $order->status_id,
						"order_details" => $arrayDetails
					));
				}

				$xml = new ArrayToXML();

				header('Content-Type: text/xml');
				print $xml->buildXML($array);
			}else if(Yii::$app->security->validatePassword($key, $data_key) && $status==200){
				$orderNumber = Yii::$app->request->get('orders');
				if($orderNumber){
					$userNumbers = explode(';',$orderNumber);
					$numbersSiteFormat = [];
					foreach ($userNumbers as $number){
						array_push($numbersSiteFormat, substr($number,2));
					}
					$clientId = Client::find()->select(['id'])->where(['in','billing_phone',$numbersSiteFormat])->asArray()->column();
					Order::updateAll(['status_id' => 11],['and',['status_id' => 2],['not in','client_id', $clientId]]); //11 обработан, выгружен в 1с
					return count($numbersSiteFormat) . ' - clients does not exist in 1c';

				}else{
					Order::updateAll(['status_id' => 11],['status_id' => 2]); //11 обработан, выгружен в 1с
					return 'success';
				}
			}else{
				return false;
			}

        //for json file
        /*
        $file = 'C:\OpenServer\domains\hectare.com\export.json';
        header ("Content-Type: application/json");
        header ("Accept-Ranges: bytes");
        header ("Content-Length: ".filesize($file));
        header ("Content-Disposition: attachment; filename=export.json");
        readfile($file);
        */

    }
	
	public function actionImportOrders(){
        $data_key = Yii::$app->request->get('key');
        $key = '1cExportOrders_hectare.com.ua';
        $key_md = Yii::$app->getSecurity()->generatePasswordHash($key);
        //echo $key_md;die();
        if (!$data_key || strlen($data_key) < 59) return ['success' => false, 'status' => 400, 'error' => 'data_key is required'];

        if (!(Yii::$app->security->validatePassword($key, $data_key))) return ['success' => false, 'status' => 400, 'error' => 'unknown key'];
        if(Yii::$app->security->validatePassword($key, $data_key)){
            $xml = file_get_contents("php://input");
			$result='';
			//print_r($xml);die();
            //$xml = file_get_contents('https://hectare.com.ua/web/xml/import2.xml');
            $array = simplexml_load_string($xml);
            foreach ($array->order as $order){
               $orderId = (string)$order->order_id;
               $comment = (string)$order->comment;
               $orderDet = $order->order_details;
               $paid = (string)$order->paid;
               $sumPartPay = (string)$order->paid['balance'] ? (string)$order->paid['balance'] : 0;
               $ttn = (string)$order->numberTTN;
               if($this->updateOrders($orderId,$comment,$paid,$sumPartPay,$ttn,$orderDet)){
                   $result = '200'; //echo 'success order '.$orderId;
               }else{
                   $result='500'; //echo 'error update orders '.$orderId;
               }
               //echo '<br>';
            }
			return $result;
        }

    }


    private function updateOrders($orderId,$comment,$paid,$sumPartPay,$ttn,$orderDet){

        $order = Order::find()->where(['id' => $orderId])->one();

        if($order){
            Order::updateAll(['comment' => $comment, 'status_id' => 7, 'paid' => $paid, 'ttn' => $ttn, 'sum_part_pay' => $sumPartPay],['id' => $orderId]); //7 завершен
            foreach ($orderDet->product as $product){
                $productId = (string)$product['product_id'];
                $quantity = (string)$product->quantity;
                $price = str_replace(',','.', (string)$product->price);
                $result = $this->updateProducts($order, $productId, $quantity, $price);
                echo $result;

            }
            //проверка содержимого заказа, если были вычерки или изменение товара, удалить позицию, проверка по 2 статусу

            $this->checkOrderProduct($order->id);
            return true;
        }else{
            return false;
        }



    }

    private function updateProducts($order, $productId1C, $quantity, $price)
    {
        $noInOrder = true;
	    foreach ($order->orderProducts as $product) {
            $result = '';
            foreach ($product->orderProductAttributeValues as $av){
                if($av->attributeValue->code1c == $productId1C){
                    OrderProduct::updateAll(['status' => 2, 'amount' => $quantity, 'price1c' => $price],['id'=>$av->order_product_id]);
                    $noInOrder = false;
                }
            $result = $av->attributeValue->code1c;
            }

            if(!$result) {
                if($product->product->attributeValues) {
                    foreach ($product->product->attributeValues as $attributeValue) {
                        if ($attributeValue->code1c == $productId1C) {
                            OrderProduct::updateAll(['status' => 2, 'amount' => $quantity, 'price1c' => $price], ['and', ['product_id' => $attributeValue->product_id], ['order_id' => $order->id]]);
                            $noInOrder = false;
                        }
                    }
                }else{
                    //return $productId1C.' - Нет данного кода товара в заказе; ';;
                }
            }

        }
        //добавление товара эсли до импорта его не было в заказе
        if($noInOrder){			
	        $attributeValue = AttributeValue::find()->where(['code1c' => $productId1C])->one();
	        if($attributeValue->product_id){
                $values = [
                    'order_id' => $order->id,
                    'product_id' => $attributeValue->product_id,
                    'status' => 2,
                    'amount' => $quantity,
                    'price1c' => $price
                ];
                $orderProduct = new OrderProduct();
                $orderProduct->attributes = $values;
                $orderProduct->save(false);
                $orderPAV = new OrderProductAttributeValue();
				
                $orderPAV->order_product_id = $orderProduct->id;
                $orderPAV->attribute_value_id = $attributeValue->id;
                if($orderPAV->save()){
                    //return $productId1C.' - Код добавлено в заказ; ';
                }
				                  
            }else{
	            //return $productId1C.' - Нет данного кода товара в магазине; ';
            }

	      //  print_r($values);
        }
    }

    private function checkOrderProduct($orderId){
        OrderProduct::deleteAll(['AND',['order_id' => $orderId], ['not in','status',2]]);
        OrderProduct::updateAll(['status' => 0],['AND',['order_id' => $orderId], ['status'=>2]]);
        return true;
    }
	
}
