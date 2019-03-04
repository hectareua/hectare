<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type_bonus_rel".
 *
 * @property integer $id
 * @property integer $ctype_bonus_id
 * @property integer $user_id
 * @property integer $confirm
 * @property string $created_at
 *
 * @property ClientTypeBonus $ctypeBonus
 * @property User $user
 */
class ClientTypeBonusRel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_type_bonus_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ctype_bonus_id', 'user_id', 'confirm','show_ones'], 'integer'],
            [['created_at'], 'safe'],
            [['ctype_bonus_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientTypeBonus::className(), 'targetAttribute' => ['ctype_bonus_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ctype_bonus_id' => 'Бонус',
            'user_id' => 'Менеджер',
            'confirm' => 'Підтверджено',
            'created_at' => 'Дата підтвердження',
            'user.client.BillingFullName' => 'Менеджер',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCtypeBonus()
    {
        return $this->hasOne(ClientTypeBonus::className(), ['id' => 'ctype_bonus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
