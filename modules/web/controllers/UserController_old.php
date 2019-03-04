<?php
namespace app\modules\web\controllers;

use yii\helpers\ArrayHelper;
use Yii;
use app\models\Client;
use app\models\Stock;
use app\models\Product;
use app\models\Stock1c;
use app\models\Manager;
use app\models\OrderStatus;
use app\models\UserReview;
use app\models\Category;
use app\modules\web\models\UserForm;
use app\modules\web\models\LoginForm;
use app\modules\web\models\PasswordResetRequestForm;
use app\modules\web\models\PasswordResetRequestForSMSCheckForm;
use app\modules\web\models\PasswordResetRequestForSMSGenerateForm;
use app\modules\web\models\ResetPasswordForm;

class UserController extends Controller
{

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
        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $user = Yii::$app->user->identity;

        $orders = [];
        $ordersTotalCount = 0;
        $ordersTotalCost = 0;
        $orderStats = [];
        $client = new Client();

        if ($user->client)
        {
            $orders = $user->client->orders;
            $ordersViaPhone = $user->client->ordersViaPhone;
            $orders = array_merge($orders, $ordersViaPhone);
            //var_dump($user->client->id);
            //var_dump($user->client->ordersViaPhone);
            //exit;


            foreach ($orders as $order)
            {
                $ordersTotalCost += $order->price;
                if (empty($orderStats[$order->status_id]))
                    $orderStats[$order->status_id] = [
                        'amount' => 0,
                        'cost' => 0,
                        'status' => $order->status
                    ];
                $orderStats[$order->status_id]['amount']++;
                $orderStats[$order->status_id]['cost'] += $order->price;
            }
            $client = $user->client;
        }
        $ordersTotalCount = count($orders);
        $closedOrders = [];
        foreach ($orders as $i => $order) {
            if ($order->status_id == OrderStatus::CLOSED_ORDER_STATUS_ID)
            {
                unset($orders[$i]);
                $closedOrders[] = $order;
            }
        }
        foreach ($orders as $i => $order) {
            if ($order->status_id == OrderStatus::CLOSED_ORDER_STATUS_ID)
            {
                unset($orders[$i]);
                $closedOrders[] = $order;
            }
        }
		
		$stock = array();
		
		if ($user->ctype==2) {
			
			$avids = [];
			
			$av = Yii::$app->db->createCommand("select id from attribute_value WHERE product_id in (select p.id from product p where p.manufacturer_id = '".$user->ctypeid."')")->queryAll();
			foreach ($av as $p) {
				$avids[] = $p['id'];
			}
			
			$products = Product::find()->all();
			$stocksi = Stock1c::find()->all();
			$stockitem = array();
		/*	foreach ($av as $p) {
				$stockitem = array_merge($stock,Stock::findAll(['avid'=>$p['id']]));
			}
			$stock[0] = $stockitem; */
			$stock[0] =Yii::$app->db->createCommand("SELECT (sum(main) + sum(franch)) as quantity,avid,product_id FROM `stock` WHERE avid in (".implode(',',$avids).") GROUP BY product_id")->queryAll();
			
			foreach ($stocksi as $s) {
				$stock[$s->id] =Yii::$app->db->createCommand("SELECT (sum(main) + sum(franch)) as quantity,avid,product_id FROM `stock` WHERE stockid=".$s->id." AND avid in (".implode(',',$avids).") GROUP BY product_id")->queryAll();	
			}
		}
		
        $userReview = new UserReview();
        if ($userReview->load(Yii::$app->request->post()))
        {
            $userReview->user_id = $user->id;
            $userReview->created_at = new \yii\db\Expression('NOW()');
            if ($userReview->save())
            {
                $userReview->trigger(UserReview::EVENT_ON_CREATE);
            }
        }

        $manager = $user->manager;

        return $this->render('index', compact('user', 'client', 'orders', 'closedOrders', 'orderStats', 'ordersTotalCount', 'ordersTotalCost', 'userReview', 'manager','stocksi','stock','products'));
    }

    public function actionEdit()
    {

        if (Yii::$app->user->isGuest)
            return $this->redirect(['login']);

        $user = Yii::$app->user->identity;
        $model = $user->client;
        if (!$model)
            $model = new Client();

        if ($user->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post()))
        {
            $model->delivery_phone = \app\helpers\PhoneDigits::get($model->delivery_phone);
            $model->billing_phone = \app\helpers\PhoneDigits::get($model->billing_phone);
            if (!$model->delivery_differs)
            {
                $model->delivery_first_name = $model->billing_first_name;
                $model->delivery_middle_name = $model->billing_middle_name;
                $model->delivery_last_name = $model->billing_last_name;
                $model->delivery_country_id = $model->billing_country_id;
                $model->delivery_region = $model->billing_region;
                $model->delivery_city = $model->billing_city;
                $model->delivery_phone = $model->billing_phone;
                $model->delivery_address = $model->billing_address;
                $model->delivery_postcode = $model->billing_postcode;
            }

            if ($user->save() && $model->save())
                return $this->redirect('index');
        }

        return $this->render('edit', compact('model', 'user'));
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $done = false;
        $user = new UserForm();
        $client = new Client();
        if ($user->load(Yii::$app->request->post()))
        {
            $done = true;
            $user->generateAuthKey();
            $user->login =  \app\helpers\PhoneDigits::get(Yii::$app->request->post('Client')['billing_phone']);
            //$user->manager_id = Manager::findOne('id'!=null)->id;
            if (!$user->validate())
            {
                $done = false;
            }
        }
        if ($done)
        {
            if ($client->load(Yii::$app->request->post()))
            {
                if (!$client->validate())
                {
                    $done = false;
                }
            }
        }
        if ($done)
        {
            $client->billing_phone = \app\helpers\PhoneDigits::get($client->billing_phone);
            $user->save();
            $client->link('user', $user);
            Yii::$app->user->login($user);
            return $this->redirect(['index']);
        }

        return $this->render('register', compact('user', 'client'));
    }

    public function actionRecoveryEmail()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    return $this->redirect(['recovery-success']);
                }
            }
        }
        return $this->render('recovery_email', compact('model'));
    }

    public function actionRecoverySms()
    {
        $model = new PasswordResetRequestForSMSGenerateForm();

                if ($model->load(Yii::$app->request->post())) {
                    $model->billing_phone = \app\helpers\PhoneDigits::get($model->billing_phone);

                    if ($model->validate()) {
                        $user = $model->getUserByPhone();
                        $this->_saveBillingPhone($model->billing_phone);

                        if (!$user->validation_code) {
                            if ($model->sendSMS()) {
                                return $this->redirect(['user/recovery-sms-check']);
                            } else {
                                return $this->redirect(['user/recovery-sms']);
                            }
                        } else {
                            $user->validation_code = NULL;
                            $user->save();
                            return $this->redirect(['user/recovery-sms']);
                        }
                    }
                }

                return $this->render('recovery_sms_generate', compact('model'));
    }

    public function actionRecoverySmsCheck()
    {
        $model = new PasswordResetRequestForSMSCheckForm();

        if ($model->load(Yii::$app->request->post())) {
                $model->billing_phone = $this->_loadBillingPhone();
                $this->_saveBillingPhone(NUll);
                $user = $model->getUserByPhone();

                    if ($user) {
                        if ($model->userHasValidationCode()) {

                            if ($user->validation_code) {
                                if ($user->validateValidationCode($model->validation_code)) {

                                    if (!empty($user->password_reset_token)) {
                                        if(!$user->isPasswordResetTokenValid($user->password_reset_token)) {
                                            $user->generatePasswordResetToken();
                                            $user->save();
                                        }
                                    } else {
                                        $user->generatePasswordResetToken();
                                        $user->save();
                                    }

                                    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['web/user/reset-password', 'token' => $user->password_reset_token]);
                                    return $this->redirect($resetLink);
                                } else {
                                    $user->validation_code = NULL;
                                    $user->save();
                                    return $this->redirect(['user/recovery-sms']);
                                }
                            } else {
                                return $this->redirect(['user/recovery-sms']);
                            }
                        }
                        $this->redirect(['user/recovery-sms']);
                    } else {
                        return $this->redirect(['user/recovery-sms']);
                    }
                 }

       return $this->render('recovery_sms_check', compact('model'));
    }

    public function actionRecovery()
    {
        $model = new PasswordResetRequestForm();
        return $this->render('recovery', compact('model'));
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (\yii\base\InvalidParamException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionRecoverySuccess()
    {
        return $this->render('recoverySuccess');
    }

    public function actionLogin($returnUrl = null)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->username = \app\helpers\PhoneDigits::get($model->username);
            if ($model->login()) {
                if (!$returnUrl)
                    $returnUrl = ['index'];
                return $this->redirect($returnUrl);
            }
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
}
