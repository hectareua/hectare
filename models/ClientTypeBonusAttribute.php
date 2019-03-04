<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type_bonus_attribute".
 *
 * @property integer $id
 * @property integer $attribute_value_id
 *
 * @property ClientTypeBonus[] $clientTypeBonuses
 */
class ClientTypeBonusAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_type_bonus_attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_value_id','rel'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rel' => 'Relation',
            'attribute_value_id' => 'Attribute Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientTypeBonuses()
    {
        return $this->hasOne(ClientTypeBonus::className(), ['ctype_bonus_av_rel' => 'rel']);
    }
}
