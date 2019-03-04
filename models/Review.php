<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $likes
 * @property integer $dislikes
 * @property integer $user_id
 * @property integer $is_visible
 * @property string $name
 * @property string $email
 * @property string $text
 * @property string $posted_at
 * @property integer $parent_id
 * @property string $phone
 * @property integer $rating
 *
 * @property User $user
 * @property Product $product
 */
class Review extends \yii\db\ActiveRecord
{
    // public $likes;
	// public $dislikes;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'review';
    }

    const EVENT_ON_CREATE = 'on-create';
    public function init()
    {
        $this->on(self::EVENT_ON_CREATE, [$this, 'sendMail']);
    }

    public function sendMail()
    {
        $receiverEmail = \app\models\SiteInfo::loadData()->contacts_email;
        if ($receiverEmail)
            Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'newReview-html', 'text' => 'newReview-text'],
                    ['model' => $this]
                )
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($receiverEmail)
                ->setSubject("Новий відгук на сайті")
                ->send();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'likes', 'dislikes', 'user_id','parent_id', 'is_visible', 'rating'], 'integer'],
            [['rating'], 'default', 'value' => 5],
            [['name', 'phone', 'text', 'posted_at'], 'required'],
            ['email' ,'email'],
            [['text'], 'string'],
            [['posted_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fields()
    {
        return [
            'id',
            'name',
            'email',
            'phone',
            'parent_id',
            'rating',
            'text',
            'user_id',
            'replies',
            'posted_at' => function($product)
            {
                return strtotime($product->posted_at);
            },
            'likes',
            'dislikes'
        ];
    }

    public function getSafeFields() {
      return [
      'id' => $this->id, 'parent_id' => $this->parent_id, 'name' => $this->name, 'text' => $this->text,
      'posted_at' => $this->posted_at, 'rating' => $this->rating, 'likes' => $this->getLikes(), 'dislikes' =>$this->getDislikes() ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Продукт',
            'user_id' => 'Користувач',
            'parent_id' => 'На #',
            'is_visible' => 'Чи видимий відгук',
            'name' => 'Ім\'я',
            'email' => 'Електронна адреса',
            'phone' => 'Телефон',
            'rating' => 'Оцінка',
            'text' => 'Відгук',
            'posted_at' => 'Дата створення',
        ];
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
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Review::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        $subQuery = Review::find()
            ->select([ "COUNT(*) as likes","review.id as review_id"])
            ->join('LEFT JOIN','like', 'review.id = like.review_id')
            ->where(['like.type' => 1])
            ->groupBy("review.id");


        $subQueryTwo = Review::find()
            ->select([ "COUNT(*) as dislikes","review.id as review_id"])
            ->join('LEFT JOIN','like', 'review.id = like.review_id')
            ->where(['like.type' => 0])
            ->groupBy("review.id");

        $replies = $this->hasMany(Review::className(), ['parent_id' => 'id'])->select(["T.likes as likes","K.dislikes as dislikes","review.*"])->leftJoin(['K' => $subQueryTwo], 'K.review_id = review.id')->leftJoin(['T' => $subQuery], 'T.review_id = review.id');

//        return $this->hasMany(Review::className(), ['parent_id' => 'id']);
        return $replies;
    }

    /*public function getVotes()
    {
        return $this->hasMany(Like::className(), ['id' => 'like_id'])
            ->viaTable('review_like', ['review_id' => 'id']);
    }*/
    
    public function getVotes()
    {
        return $this->hasMany(Like::className(), ['review_id' => 'id']);
    }

    public function getDislikes()
    {
        return (int)$this->getVotes()->andWhere(['type' => LIKE::DISLIKE])->count();
    }

    public function getLikes()
    {
        return (int)$this->getVotes()->andWhere(['type' => LIKE::LIKE])->count();
    }


}
