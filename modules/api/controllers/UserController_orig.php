<?php

namespace app\modules\api\controllers;

use app\models\AnonymusPush;
use Yii;
use app\models\User;
use app\models\Client;
use app\models\Manager;

use yii\helpers\ArrayHelper;
use app\modules\web\models\UserForm;
use app\modules\web\models\LoginForm;
use app\modules\web\models\PasswordResetRequestForm;
use app\modules\web\models\PasswordResetRequestForSMSCheckForm;
use app\modules\web\models\PasswordResetRequestForSMSGenerateForm;
use app\modules\web\models\ResetPasswordForm;

class UserController extends ApiController
{
	public function actionIndex($auth_key)
	{
        $this->serializer['expand'] = ['email', 'manager'];
        $user = User::findOne(['auth_key' => $auth_key]);
        if (!$user)
        	return null;

		return [
			'user' => $this->serializeData($user),
			'client' => $this->serializeData($user->client),
		];
	}

	public function actionRegister()
	{
		$data = Yii::$app->request->post('user');
		$user = new User($data);
		$user->generateAuthKey();
		$user->manager_id = Manager::findOne('id'!=null)->id;
		if (!$user->validate())
		{
			return ['success' => false, 'errors' => ['user' => $user->getErrors()]];
		}
		$data = Yii::$app->request->post('client');
		$client = new Client($data);
		if (!$client->validate())
		{
			return ['success' => false, 'errors' => ['client' => $client->getErrors()]];
		}
		$user->save();
		$client->link('user', $user);
		return ['success' => true, 'auth_key' => $user->auth_key];
	}

	public function actionEdit()
	{
		$auth_key = Yii::$app->request->post('auth_key');
		if (!$auth_key)
			return ['success' => false, 'status' => 400, 'error' => 'auth_key is required'];
		$user = User::findOne(['auth_key' => $auth_key]);
		if (!$user)
			return ['success' => false, 'status' => 403, 'error' => 'Access denied'];

		$data = Yii::$app->request->post('user');
		$user->setAttributes($data);
		if (!empty($data['password']))
			$user->password = $data['password'];
		if (!$user->save())
		{
			return ['success' => false, 'errors' => ['user' => $user->getErrors()]];
		}
		$data = Yii::$app->request->post('client');
		$client = $user->client;
		$client->setAttributes($data);
		if (!$client->save())
		{
			return ['success' => false, 'errors' => ['client' => $client->getErrors()]];
		}

		return ['success' => true];
	}

	public function actionLogin($login, $password)
	{
		$user = User::findByLogin($login);
		if ($user)
		{
			 if ($user->validatePassword($password))
			 {
				return ['success' => true, 'auth_key' => $user->auth_key];
			 }
		}
		return ['success' => false];
	}

	public function actionRecovery()
	{
		$email = Yii::$app->request->post('email');
		$user = User::findOne(['email' => $email]);
		if (!$user)
		{
			return ['success' => false];
		}
		$newPassword = Yii::$app->getSecurity()->generateRandomString(Yii::$app->params['user.randomPasswordLength']);
    	$user->password = $newPassword;
    	$user->save();

        if (!Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordRecovery-html', 'text' => 'passwordRecovery-text'],
                ['newPassword' => $newPassword]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
            ->setTo($user->email)
            ->setSubject(Yii::t('app', 'Новый пароль от ') . Yii::$app->name)
            ->send())
            return ['success' => false];

		return ['success' => true];
	}

	public function actionRecoverySms()
	{
        $model = new PasswordResetRequestForSMSGenerateForm();
        $model->billing_phone = Yii::$app->request->post('billing_phone');
        $model->billing_phone = \app\helpers\PhoneDigits::get($model->billing_phone);
        if (!$model->validate()) {
            throw new \yii\web\BadRequestHttpException('невірно вказаний номер');
        }
        $model->sendSMS();
	}

	public function actionRecoverySmsCheck()
	{
        $model = new PasswordResetRequestForSMSCheckForm();
        $model->validation_code = Yii::$app->request->post('validation_code');
        $model->billing_phone = Yii::$app->request->post('billing_phone');
        $user = $model->getUserByPhone();
        if (!$user) {
            throw new \yii\web\BadRequestHttpException('невірно вказаний номер');
        }
        if (!$model->userHasValidationCode()) {
            throw new \yii\web\BadRequestHttpException('ви не відновлювали пароль');
        }
        if (!$user->validateValidationCode($model->validation_code)) $this->failValidationCode($user);
        if(!$user->isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            $user->save();
        }

        return $this->successValidationCode($user->password_reset_token);
    }

    public function actionResetPassword()
    {
        $token = Yii::$app->request->post('token');
        try {
            $model = new ResetPasswordForm($token);
        } catch (\yii\base\InvalidParamException $e) {
            throw new \yii\web\BadRequestHttpException('Неправильний ідентифікатор');
        }
        $model->password = Yii::$app->request->post('password');
        $model->passwordConfirmation = Yii::$app->request->post('passwordConfirmation');
        if (!$model->validate()) {
            throw new \yii\web\BadRequestHttpException('Паролі не співпадають');
        }
        $model->resetPassword();
    }

    private function badRequest() {
        Yii::$app->response->statusCode = 400;
    }

    private function failValidationCode($user) {
        $user->validation_code = NULL;
        $user->save();
        throw new \yii\web\BadRequestHttpException('неправильний код');
    }

    private function successValidationCode($token)
    {
        return ['token' => $token];
    }

    public function resetPasswordBadRequest() {

    }
}
