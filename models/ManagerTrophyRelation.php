<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manager_trophy_relation".
 *
 * @property integer $id
 * @property integer $manager_id
 * @property integer $manager_trophy_id
 *
 * @property Manager $manager
 * @property ManagerTrophy $managerTrophy
 */
class ManagerTrophyRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manager_trophy_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manager_id', 'manager_trophy_id'], 'required'],
            [['manager_id', 'manager_trophy_id'], 'integer'],
            [['manager_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['manager_id' => 'id']],
            [['manager_trophy_id'], 'exist', 'skipOnError' => true, 'targetClass' => ManagerTrophy::className(), 'targetAttribute' => ['manager_trophy_id' => 'id']],
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
            'manager_trophy_id' => 'Нагорода',
        ];
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
    public function getManagerTrophy()
    {
        return $this->hasOne(ManagerTrophy::className(), ['id' => 'manager_trophy_id']);
    }
}
