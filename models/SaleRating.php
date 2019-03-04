<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_rating".
 *
 * @property integer $id
 * @property string $code1c
 * @property string $sale_sum
 * @property string $rating_date
 * @property integer $type
 */
class SaleRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sale_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['updated_at'], 'safe'],
            [['code1c'], 'required'],
            [['sale_sum'], 'number'],
            [['rating_date'], 'safe'],
            [['type'], 'integer'],
            [['code1c'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code1c' => 'Code1c',
            'sale_sum' => 'Sale Sum',
            'rating_date' => 'Rating Date',
            'type' => 'Type',
        ];
    }
}
