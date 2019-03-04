<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type".
 *
 * @property integer $id
 * @property string $name_uk
 */
class ClientType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_uk'], 'required'],
            [['name_uk'], 'string', 'max' => 255],
            [['order','stock','arch_order','depart_eval','vote','period_vote','worker','stock_with_filter','rating',
                'shop','bonus','stock_in_cart','partner_price','create_order','document'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => 'Тип клієнта',
            'order' => 'Замовлення',
            'stock' => 'Залишки по складам',
            'arch_order' => 'Архівні замовлення',
            'depart_eval' => 'Відсоток виконання плану/оцінка відділу',
            'vote' => 'Голосування',
            'period_vote' => 'Період через який відбувається голосування (дні)',
            'worker' => 'Співробітники',
            'stock_with_filter' => 'Залишки з фільтрами',
            'rating' => 'Рейтинг',
            'shop' => 'Магазин',
            'bonus' => 'Бонуси',
            'stock_in_cart' => 'Залишки в картці товару',
            'partner_price' => 'Показати партнерську ціну',
            'create_order' => 'Можливість формування заказу з адмінки',
            'document' => 'Документи',
        ];
    }
}
