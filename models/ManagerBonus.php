<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager_bonus".
 *
 * @property integer $id
 * @property string $manager_code1c
 * @property string $sum_bonus
 * @property string $bonus_date
 */
class ManagerBonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum_bonus'], 'number'],
            [['bonus_date'], 'safe'],
            [['manager_code1c'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'manager_code1c' => 'Manager Code1c',
            'sum_bonus' => 'Sum Bonus',
            'bonus_date' => 'Bonus Date',
        ];
    }
}
