<?php
namespace app\modules\web\controllers;

use app\components\delivery\DeliveryCalculator;
use app\components\delivery\DeliveryFactory;
use app\models\Product;
use app\models\Representative;
use app\models\Stock;
use Yii;
use app\models\CartItem;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Category;
use app\models\OrderProductAttributeValue;
use app\models\PaymentSystem;
use app\models\Manager;
use app\models\Client;
use app\modules\web\models\LoginForm;
use app\modules\web\models\UserForm;
use PayParts\PayParts;
use yii\web\Response;

class CartController extends Controller
{
    private $purchaseType;
    public $enableCsrfValidation = false;

    public function beforeAction($action) {
        $parentCategories = Category::find()
            ->where(['parent_id' => null])
            ->with('categories', 'image')->orderBy('order')
            ->all();
        $this->view->params['parentCategories'] = $parentCategories;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $bonusRequest = CartItem::existsBonusRequest();
        $models = $this->_loadCart();
        $bonuses = CartItem::getAllBonuses();

        $purchaseType = $this->_loadPurchaseType();
        $totalPrice = 0;
        $totalBonusUsed = 0;
        foreach ($models as $model) {

            if (!$bonusRequest && $purchaseType == 0) {
                $totalBonusUsed += $model->bonusUsed;
            }

            $totalPrice += $model->totalPrice;

        }

   /*

Yii::$app->session->open();
Yii::$app->session->set("cartitem2", 'fghghfghfgfghf');
$cookies = Yii::$app->response->cookies;

// добавление новой куки в HTTP-ответ
$cookies->add(new \yii\web\Cookie([
    'name' => 'cartitem22',
    'value' => 'TTT'. $cookies->getValue('complects', '') .' XXX',
]));
$_SESSION['test']='text';

        */
		$isajax = Yii::$app->request->get('isajax');
		if($isajax=="1"){
			$res = $this->renderPartial('ajax_index', compact('models', 'bonusRequest', 'bonuses', 'totalBonusUsed', 'totalPrice', 'purchaseType'));
			echo $res; die();
		}
        return $this->render('index', compact('models', 'bonusRequest', 'bonuses', 'totalBonusUsed', 'totalPrice', 'purchaseType'));
    }

    public function actionCheckout()
    {
        /** @var CartItem[] $cart */
        $cart = $this->_loadCart();
        $purchaseType = $this->_loadPurchaseType();
        $totalPrice = 0;
        $bonusUsed = 0;
        $enableInStock = true;
        foreach ($cart as $cartItem) {
            $bonusUsed += $cartItem->bonusUsed;
            $totalPrice += $cartItem->totalPrice;
            if ($enableInStock) {
                $stock = Stock::find()->where(['and', ['product_id' => $cartItem->product_id], ['>', 'main', $cartItem->amount]])->one();
                if (!$stock) {
                    $enableInStock = false;
                }
            }
        }
        $paymentSystems = PaymentSystem::find()->all();
        $loginForm = new LoginForm();
        $model = new Order();
        $userForm = new UserForm();
        $client = new Client();
        if (!Yii::$app->user->isGuest)
        {
            $user = Yii::$app->user->identity;
            if ($user)
            {
                $model->billing_email = $user->email;
                if ($user->client)
                {
                    $model->delivery_fullname = $user->client->deliveryFullName;
                    $model->delivery_city = $user->client->delivery_city;
                    $model->delivery_phone = $user->client->delivery_phone;
                    $model->delivery_address = $user->client->delivery_address;
                    $model->client_id = $user->client->id;
                }
            }
        }
        $done = false;
        $register = Yii::$app->request->post('register');

        $paymentSystem = PaymentSystem::find()->where(['id' => 0])->one();
        $representative = Representative::find()->all();
        if ($model->load(Yii::$app->request->post()))
        {
            $priceWithDelivery = Yii::$app->request->post('totalPrice');
            if ($priceWithDelivery && $priceWithDelivery > $totalPrice){
                //add delivery to total price
                $totalPrice = $priceWithDelivery;
            }

            $paymentSystem = PaymentSystem::find()->where(['id' => $model->payment_system_id])->one();

            $done = true;
            $model->status_id = 1;
            if (!empty($_COOKIE['shop'])){
                $model->representative_id = $_COOKIE['shop'];
            }

                if ($bonusUsed > 0) {
                $model->bonus_write_off_request = $bonusUsed;
            }
            $model->ordered_at = new \yii\db\Expression('NOW()');
            $model->billing_fullname = $model->delivery_fullname;
            $model->billing_city = $model->delivery_city;
            $model->billing_phone = $model->delivery_phone;
            if (!$model->validate())
            {
                $done = false;
            }
            if ($register && $userForm->load(Yii::$app->request->post()))
            {
                $userForm->generateAuthKey();
                $userForm->manager_id = Manager::findOne('id'!=null)->id;
                $userForm->email = $model->billing_email;
                if (!$userForm->validate())
                {
                    $done = false;
                }
                $model->delivery_fullname = preg_replace('/\s+/', ' ', trim($model->delivery_fullname));
                $parts = explode(' ', $model->delivery_fullname);
                switch (count($parts))
                {
                    case 1:
                        $client->delivery_first_name = $client->billing_first_name = $parts[0];
                        break;
                    case 2:
                        $client->delivery_last_name = $client->billing_last_name = $parts[0];
                        $client->delivery_first_name = $client->billing_first_name = $parts[1];
                        break;
                    case 3:
                    default:
                        $client->delivery_last_name = $client->billing_last_name = $parts[0];
                        $client->delivery_first_name = $client->billing_first_name = $parts[1];
                        $client->delivery_middle_name = $client->billing_middle_name = $parts[2];
                        break;
                }
                $client->delivery_phone = $client->billing_phone = $model->delivery_phone;
                $client->delivery_city = $client->billing_city = $model->delivery_city;
                $client->delivery_address = $client->billing_address = $model->delivery_address;
            }
        }
        if ($done)
        {
            $transaction = Yii::$app->db->beginTransaction();
            try
            {
                if ($register)
                {
                    $userForm->save();
                    $client->link('user', $userForm);
                    $model->client_id = $client->id;
                    Yii::$app->user->login($userForm);
                }
                $model->save();
                foreach ($cart as $cartItem)
                {
                    $orderProduct = new OrderProduct();
                    $orderProduct->product_id = $cartItem->product_id;
                    $orderProduct->amount = $cartItem->amount;
                    if (1 - $cartItem->product->discountRate)
                    {
                        $orderProduct->discount = $cartItem->product->discount;
                    }
                    $orderProduct->link('order', $model);
                    foreach ($cartItem->attributeValues as $attributeValue)
                    {
                        $orderProductAttributeValue = new OrderProductAttributeValue();
                        $orderProductAttributeValue->order_product_id = $orderProduct->id;
                        $orderProductAttributeValue->attribute_value_id = $attributeValue->id;
                        $orderProductAttributeValue->save();
                    }
                }

                $model->trigger(Order::EVENT_ON_CREATE);
                $transaction->commit();


                if ($paymentSystem->type != 0) {
                    $this->_saveCart([]);
                    //$this->_saveOrderId($model->id);
                    $this->redirect(['success', 'order_id'=>$model->id, 'totalPrice'=>$totalPrice ]);
                    //return $paymentSystem->type;
                } else {
                    $this->_saveOrderId($model->id);
                    $this->_saveTotalPrice($totalPrice);
                    return $model->id;
                }
            }
            catch(\Exception $e)
            {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('checkout', compact('model', 'cart', 'totalPrice', 'paymentSystems', 'loginForm', 'userForm', 'user', 'register' , 'purchaseType','representative', 'enableInStock'));
    }

    public function actionPaymentRedirect()
    {
        $pp = Yii::$app->get('pp');

        $orderId = "ORDER"."-".$this->_loadOrderId();
        $order = Order::find()->where(['id' => $this->_loadOrderId()])->one();

        $getState = $pp->getState($orderId, false); //orderId, showRefund

        /*можно ожидать результат платежа который пришёл в ResponseUrl*/

        if ($getState !== 'error') {
            if ($getState['paymentState'] === 'LOCKED' && $getState['state'] === 'SUCCESS') {

                $order->setAttribute('status_id', ORDER::PAYPARTS_NOT_CONFIRMED);
                if ($order->save()) {
                    $id = $this->_loadOrderId();
                    $totalPrice = $this->_loadTotalPrice();

                    $this->_saveOrderId(NULL);
                    $this->_saveTotalPrice(NULL);

                    $this->redirect(['success', 'order_id' => $id, 'totalPrice' => $totalPrice]);
                    //echo 'SUCCESS';
                }

                /*проводим проводки на магазине оплата прошла
                если был создан Отложенный платеж то делаем подтверждение
                $ConfirmHold=$pp->ConfirmHold($_SESSION['OrderID']);
                или отказываемся если нужно
                $CancelHold=$pp->CancelHold('ORDER-D3AE1082C5E2F81F2A904EAC3DB990E0A8F211B0'
                анализируем $ConfirmHold там будет результат операции*/
            }
        }else {
            echo $getState['paymentState'];
            /*есть ошибки в оплате или отказ*/
        }

    }

    public function actionPayParts($merchantType = 'PP')
    {
        $pp = Yii::$app->get('pp');
        $productsList = [];
        $product = [];
        $cart = $this->_loadCart();
        $orderId = $this->_loadOrderId();
        $host = Yii::$app->params['host'];

        foreach ($cart as $index=>$model) {
            $product['name'] = $model->product->name;
            $product['price'] = $model->price;
            $product['count'] = $model->amount;
            $productsList[] = $product;
        }

        if (Yii::$app->request->post('PartsCountInput')) {
            $options = array(
                'ResponseUrl' => $host . '/response.php',          //URL, на который Банк отправит результат сделки (НЕ ОБЯЗАТЕЛЬНО)
                'RedirectUrl' => $host . '/internet-magazin/cart/payment-redirect',          //URL, на который Банк сделает редирект клиента (НЕ ОБЯЗАТЕЛЬНО)
                'PartsCount' => (int)Yii::$app->request->post('PartsCountInput'),  //Количество частей на которые делится сумма транзакции ( >1)
                'Prefix' => '',                                  //Параметр не обязательный если Prefix указан с пустотой или не указа вовсе префикс будет ORDER
                'OrderID' => $orderId,                                 //Если OrderID задан с пустотой или не укан вовсе OrderID сгенерится автоматически
                'merchantType' => $merchantType,                          //II - Мгновенная рассрочка; PP - Оплата частями; PB - Оплата частями. Деньги в периоде. IA - Мгновенная рассрочка. Акционная.
                 //'Currency' => '980',                             //Валюта по умолчанию 980 – Украинская гривна; Значения в соответствии с ISO
                'ProductsList' => $productsList,                 //Список продуктов, каждый продукт содержит поля: name - Наименование товара price - Цена за еденицу товара (Пример: 100.00) count - Количество товаров данного вида
                'recipientId' => ''                              //Идентификатор получателя, по умолчанию берется основной получатель. Установка основного получателя происходит в профиле магазина.
            );
        }

        $pp->setOptions($options);
        //exit;

        $send = $pp->create('hold'); //hold //pay
        $this->_saveCart([]);
        //$this->_saveOrderId(null);

        $this->redirect('https://payparts2.privatbank.ua/ipp/v2/payment?token='.$send['token']);
    }

    public function actionInstantPayment()
    {
        $this->actionPayParts('II');
//        $pp = Yii::$app->get('pp');
//        $productsList = [];
//        $product = [];
//        $cart = $this->_loadCart();
//        $orderId = $this->_loadOrderId();
//        $host = Yii::$app->params['host'];
//
//        foreach ($cart as $index=>$model) {
//            $product['name'] = $model->product->name;
//            $product['price'] = $model->price;
//            $product['count'] = $model->amount;
//            $productsList[] = $product;
//        }
//
//        if (Yii::$app->request->post('PartsCountInput')) {
//            $options = array(
//                'ResponseUrl' => $host . '/response.php',          //URL, на который Банк отправит результат сделки (НЕ ОБЯЗАТЕЛЬНО)
//                'RedirectUrl' => $host . '/internet-magazin/cart/payment-redirect',          //URL, на который Банк сделает редирект клиента (НЕ ОБЯЗАТЕЛЬНО)
//                'PartsCount' => (int)Yii::$app->request->post('PartsCountInput'),  //Количество частей на которые делится сумма транзакции ( >1)
//                'Prefix' => '',                                  //Параметр не обязательный если Prefix указан с пустотой или не указа вовсе префикс будет ORDER
//                'OrderID' => $orderId,                                 //Если OrderID задан с пустотой или не укан вовсе OrderID сгенерится автоматически
//                'merchantType' => 'II',                          //II - Мгновенная рассрочка; PP - Оплата частями; PB - Оплата частями. Деньги в периоде. IA - Мгновенная рассрочка. Акционная.
//                //'Currency' => '980',                             //Валюта по умолчанию 980 – Украинская гривна; Значения в соответствии с ISO
//                'ProductsList' => $productsList,                 //Список продуктов, каждый продукт содержит поля: name - Наименование товара price - Цена за еденицу товара (Пример: 100.00) count - Количество товаров данного вида
//                'recipientId' => ''                              //Идентификатор получателя, по умолчанию берется основной получатель. Установка основного получателя происходит в профиле магазина.
//            );
//        }
//
//        $pp->setOptions($options);
//        //exit;
//
//        $send = $pp->create('hold'); //hold //pay
//        $this->_saveCart([]);
//        //$this->_saveOrderId(null);
//
//        $this->redirect('https://payparts2.privatbank.ua/ipp/v2/payment?token='.$send['token']);
    }

    public function actionSuccess($order_id, $totalPrice)
    {
        $order = Order::findOne($order_id);

        return $this->render('success', compact('totalPrice', 'order'));
    }

    public function actionClear()
    {
        $this->_saveCart([]);
        return $this->redirect(['cart/index']);
    }

    public function actionRefresh()
    {
        $data = Yii::$app->request->post('cart');
		$isajax = Yii::$app->request->post('isajax');
        $bonusesUsed = Yii::$app->request->post('bonusUsed');

        $bonusRequest = CartItem::existsBonusRequest();
        $cart = $this->_loadCart();
        $purchaseType = $this->_loadPurchaseType();

        foreach ($data as $index => $amount) {
            if ($amount != 0) {
            $cart[$index]->amount = $amount;
            } else {
				$result = $this->redirect(['cart/index']);
				if($isajax){
					echo json_encode((object)array("success"=>true,"redirect"=>$result->getHeaders()->get("x-redirect")));
					exit();
				}
				return $result;
            }
        }

        if (!$bonusRequest && $purchaseType == 0) {
            $bonuses = CartItem::getAllBonuses();
            $totalBonusUsed = 0;
            if ($bonusesUsed) {
                foreach ($bonusesUsed as $bonus) {
                    $totalBonusUsed += $bonus;
                }

                foreach ($bonusesUsed as $index => $bonus) {

                    if (($totalBonusUsed <= $bonuses) && (($cart[$index]->price - $cart[$index]->bonusUsed) > 0)) {
                        $cart[$index]->bonusUsed = $bonus;
                    }
                    $this->_saveCart($cart);
                }
            } else {
                $this->_saveCart($cart);
            }
        } else {
            $this->_saveCart($cart);
        }
		$result = $this->redirect(['cart/index']);
		if($isajax){
			echo json_encode((object)array("success"=>true,"redirect"=>$result->getHeaders()->get("x-redirect")));
			exit();
		}
		return $result;
    }

	public function actionAdd($product_id)
    {
        $attrs = Yii::$app->request->post('attrs');
        $amount = Yii::$app->request->post('amount');
        $purchaseType = Yii::$app->request->post('purchaseType');
		$isajax = Yii::$app->request->post('isajax');
		if (!$amount)
            throw new \yii\web\NotFoundHttpException();
        $cart = $this->_loadCart();
        $equalExists = false;
        foreach ($cart as $cartItem) {
            if ($cartItem->product_id == $product_id) {
                if ($cartItem->attrs && $attrs) {
                    foreach ($attrs as $attributeValueId) {
                        foreach ($cartItem->attrs as $_attributeValueId) {
                            if ($_attributeValueId == $attributeValueId) {
                                $equalExists = true;
                            }
                        }
                    }
                } else {
                    $equalExists = false;
                }
            }
            if ($equalExists) {
                $cartItem->amount += $amount;
            }
        }
        if (!$equalExists) {
            $cart[] = new CartItem(compact('product_id', 'amount', 'attrs'));
        }
        $this->_saveCart($cart);
        $this->_savePurchaseType($purchaseType);
		$result = $this->redirect(['cart/index']);
		if($isajax){
		    echo json_encode((object)array("success"=>true,"redirect"=>$result->getHeaders()->get("x-redirect")));
			exit();
		}
        return $result;
    }

    /**
     * This method returns OrderSum
     *
     * @return int
     */
    private function getOrderSum()
    {
        $models = $this->_loadCart();

        $totalPrice = 0;
        foreach ($models as $model) {
            $totalPrice += $model->totalPrice;
        }

        return $totalPrice;
    }

    /**
     * This method calculates order weight
     *
     * @return float|int
     */
    private function getOrderWeight()
    {
        $cartItems = $this->_loadCart();
        $weight = 0;
        foreach ($cartItems as $cartItem) {
            foreach ($cartItem->attributeValues as $attributeValue){
                if ($attributeValue->option->multiplier){
                    $weight += $attributeValue->option->multiplier / 10000;
                }
            }
        }

        return $weight;
    }

    /**
     * @return array
     */
    public function actionGetDeliveryPrice()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $orderPrice = $this->getOrderSum();
        $totalPrice = $orderPrice;

        if (Yii::$app->request->isAjax){
            $address = Yii::$app->request->post('address');
            $city = Yii::$app->request->post('city');
            $deliveryType = Yii::$app->request->post('deliveryType');

            if ($city && $deliveryType){
                $weight = $this->getOrderWeight();
                /** @var DeliveryCalculator $deliveryCalculator */
                $deliveryCalculator = DeliveryFactory::create($deliveryType, $weight);
                if (!$deliveryType || !$deliveryCalculator){
                    return ['success' => 'false', 'totalPrice' => $totalPrice,];
                }
                try {
                    $distance = Yii::$app->googleMapComponent->getDistanceFromShop($city, $address)['distance'];
                } catch (\Exception $e){
                    return ['success' => 'false', 'error' => $e->getMessage()];
                }

                $price = $deliveryCalculator->calculateDeliveryPrice($distance);
                $html = $deliveryCalculator->output($distance, $orderPrice);
                $isFree = $deliveryCalculator->isFree($distance, $orderPrice);

                if (!$isFree){
                    $totalPrice += $price;
                }

                return [
                    'success' => 'true',
                    'html' => $html,
                    'price' => $price,
                    'distance' => $distance,
                    'isFree' => $isFree,
                    'totalPrice' => $totalPrice,
                ];
            }
        }

        return [
            'success' => 'false',
            'totalPrice' => $totalPrice,
        ];
    }

    private function getPriceForDistance()
    {
        return 5;
    }

    public function actionRemove($index)
    {
        if(isset($_COOKIE['complects'])) {
            unset($_COOKIE['complects']);
            setcookie('complects', null, -1, '/');
        }
        $isajax = Yii::$app->request->get('isajax');

		$cart = $this->_loadCart();
        unset($cart[$index]);
        $cart = array_values($cart);
        $this->_saveCart($cart);
		$result = $this->redirect(['cart/index']);
		if($isajax=="1"){
		    echo json_encode((object)array("success"=>true,"redirect"=>$result->getHeaders()->get("x-redirect")));
			exit();
		}
        return $result;
    }
}
