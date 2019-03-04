<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager_sale_plan".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property integer $sum_plan
 * @property string $plan_date
 *
 * @property Manager $manager
 */
class ManagerSalePlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $plan_date_year;
    public static function tableName()
    {
        return 'manager_sale_plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id', 'sum_plan','plan_year'], 'integer'],
            [['manager_id', 'sum_plan','plan_year'], 'required'],
            [['plan_date','plan_date_year'], 'safe'],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manager_id' => 'Менеджер',
            'plan_year' => 'План на рік',
            'sum_plan' => 'Сума плану (грн)',
            'plan_date' => 'Місяць',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManager()
    {
        return $this->hasOne(Manager::className(), ['id' => 'manager_id']);
    }
}
