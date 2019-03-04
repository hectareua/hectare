<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_discount_card".
 *
 * @property integer $id
 * @property string $client_code1c
 * @property string $name
 * @property string $card
 * @property string $phone
 */
class ClientDiscountCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_discount_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_code1c', 'name', 'card', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_code1c' => 'Client Code1c',
            'name' => 'Name',
            'card' => 'Card',
            'phone' => 'Phone',
        ];
    }
}
