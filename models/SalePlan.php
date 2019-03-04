<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sale_plan".
 *
 * @property integer $id
 * @property integer $plan_sum
 * @property string $plan_date
 */
class SalePlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $plan_date_year;
    public static function tableName()
    {
        return 'sale_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_sum','plan_year'], 'integer'],
            [['plan_sum','plan_year'], 'required'],
            [['plan_date', 'plan_date_year'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_sum' => 'План, грн',
            'plan_year' => 'План на рік',
            'plan_date' => 'Дата',
            'plan_date_year' => 'Дата',
        ];
    }
}
