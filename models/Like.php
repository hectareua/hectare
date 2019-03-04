<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "like".
 *
 * @property integer $id
 * @property integer $review_id
 * @property integer $type
 * @property integer $user_id
 *
 * @property User $user
 */
class Like extends \yii\db\ActiveRecord
{
    const LIKE = 1;
    const DISLIKE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'boolean'],
            [['review_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'review_id' => 'Review ID',
            'type' => 'Type',
            'user_id' => 'User ID'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['id' => 'review_id'])
            ->viaTable('review_like', ['like_id' => 'id']);
    }
}
