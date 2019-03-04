<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property string $login
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $email
 * @property integer $is_admin
 * @property integer $is_active
 * @property string $push_token
 * @property string $password write-only password
 *
 * @property Client[] $client
 * @property Forum[] $forums
 * @property ForumMessage[] $forumMessages
 * @property ProductQuestion[] $productQuestions
 * @property Review[] $reviews
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $new_password;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    public static function sendPushMessageToEveryone($route ='', $title, $text)
    {
      $pushTokens = AnonymusPush::getPushTokens();
              //Yii::$app->pushcomponent->send($route, $title, $text, 'c_jYXTxbcWU:APA91bF6bJzEMnly-TnOfEqVfKtzbKDFAxrx5fB9w-R1hqYcsi7bW1zmBFzgAqw5vbdKvffREp-WAF6FuoS8y5U9--qE3P6zrYTIz84pKdvYd1wrTac3xGqCFpUkkLpCYm9XfEIZr7qu');

      foreach ($pushTokens as $pushToken) Yii::$app->pushcomponent->send($route, $title, $text, $pushToken);
    }

    /*public function sendPushMessage($message)
    {
        if ($this->push_token)
            Yii::$app->push->send([
                'title' => Yii::$app->name,
                'body' => $message,
            ], $this->push_token);
    }*/
    
    public function sendPushMessage($message)
    {
        if ($this->push_token)
            Yii::$app->pushcomponent->send('',Yii::$app->name, $message,$this->push_token);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password_hash', 'auth_key', 'email'], 'required'],
            [['is_admin', 'is_active', 'manager_id','ctype','ctypeid'], 'integer'],
            [['login', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['password_hash', 'auth_key', 'validation_code'], 'string', 'max' => 32],
            [['new_password', 'push_token'], 'safe'],
            [['push_token'], 'string', 'length' => [10, 300]],
            // [['push_token'], 'unique'],
            [['email', 'login', 'password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'login',
        ];
    }

    /**
     * @inheritdoc
     */
    public function extraFields()
    {
        return [
            'auth_key',
            'email',
            'manager',
            // 'client',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => \Yii::t('user', 'login'),
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'email' => \Yii::t('user', 'email'),
            'is_admin' => 'Чи адміністратор',
            'is_active' => 'Чи активний',
            'new_password' => 'Пароль',
            'manager_id' => 'Менеджер',
            'ctype'=>'Тип клиента',
            'ctypeid'=>'Служебное поле для типа клиента',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrend()
    {
        return $this->hasOne(Client::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'ctypeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForums()
    {
        return $this->hasMany(Forum::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumMessages()
    {
        return $this->hasMany(ForumMessage::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductQuestions()
    {
        return $this->hasMany(ProductQuestion::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['user_id' => 'id']);
    }

    public function getName()
    {
        $name = null;
        $client = $this->client;
        if ($client)
        {
            $name = $client->billing_first_name;
            if (!$name)
                $name = $client->delivery_first_name;
            if (!$name)
                $name = $client->billing_last_name;
            if (!$name)
                $name = $client->delivery_last_name;
        }
        if (!$name)
            $name = $this->email;
        if (!$name)
            $name = "user #".$this->id;
        return $name;
    }
	
	public function getFirstLastName()
    {
        $name = null;
        $client = $this->client;
        if ($client)
        {
            $name = $client->billing_first_name;
            $lastName = $client->billing_last_name;
            if (!$name)
                $name = $client->delivery_first_name;
            if (!$lastName)
                $lastName = $client->delivery_last_name;
        }

        if (!$name && !$lastName)
            $name = "user #".$this->id;
        return $lastName.'<br />'.$name;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @return string hash of password
     */
    public function hashPassword($password)
    {
        return md5(Yii::$app->params['user.passwordSalt'].trim($password).Yii::$app->params['user.passwordSalt']);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->hashPassword($password) === $this->password_hash;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validateValidationCode($password)
    {
        return $this->hashPassword($password) === $this->validation_code;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = $this->hashPassword($password);
    }

    /**
     * Generates password hash from password and sets it to the model in validation_code column
     *
     * @param string $password
     */
    public function setValidationCode($password)
    {
        $this->validation_code = $this->hashPassword($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = md5(uniqid());
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = md5(uniqid()) . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
	
	public function getCabinetTrophy(){
        $managerCode = $this->manager->code1c;
        $ratingSum = Yii::$app->db->createCommand("
                                    select sum(sale_sum) as summ from sale_rating
                                    where code1c = '$managerCode' and rating_date between MAKEDATE(year(now()),1) and now()
            ")->queryOne();
        // print_r($ratingSum['summ']);
        $trophy = ManagerTrophy::find()->where(['and',['<=','min_sale',$ratingSum['summ']],['>','max_sale',$ratingSum['summ']]])->one();
        $countStars = 1+($ratingSum['summ']-$trophy->min_sale)/($trophy->step ? $trophy->step:0.0001);
        $showTrophy = array(
            'trophyUrl' => $trophy->image->url,
            'stars' => (int)$countStars
        );
        return $showTrophy;
    }
	
	    public function getClientType(){
        return $this->hasOne(ClientType::className(), ['id' => 'ctype']);
    }
}
