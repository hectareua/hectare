<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_type_bonus".
 *
 * @property integer $id
 * @property integer $client_type_id
 * @property integer $qty_one
 * @property integer $qty_all
 * @property string $date_from
 * @property string $date_to
 *
 * @property ClientType $clientType
 * @property ClientTypeBonusRel[] $clientTypeBonusRels
 */
class ClientTypeBonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $attrs;
    public static function tableName()
    {
        return 'client_type_bonus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_type_id', 'qty_sale','manufacturer_id','stage','money_plan','show_condition','attribute_value_id', 'currency','ctype_bonus_av_rel','unit'], 'integer'],
            [['bonus_one', 'bonus_all'],'number'],
            [['date_from', 'date_to','manufacturer_id','currency','client_type_id'], 'required'],
            [['date_from', 'date_to','attrs'], 'safe'],
            [['name_bonus_uk','name_bonus_ru','percent_stage','condition_uk','condition_ru'], 'string'],
            [['client_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientType::className(), 'targetAttribute' => ['client_type_id' => 'id']],
            [['manufacturer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manufacturer::className(), 'targetAttribute' => ['manufacturer_id' => 'id']],
            [['attribute_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['attribute_value_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_bonus_uk'=>'Назва бонусу укр',
            'name_bonus_ru'=>'Назва бонусу рос',
            'condition_uk'=>'Умова укр',
            'condition_ru'=>'Умова рос',
            'show_condition'=>'Показати умову',
            'manufacturer_id'=>'Виробник',
            'attribute_value_id' => 'Товар',
            'ctype_bonus_av_rel' => 'Декілька товарів',
            'attrs' => 'Декілька товарів',
            'unit' => 'Бонус поставити в літрах/кг',
            'client_type_id' => 'Група працівників, яким назначається бонус',
            'currency' => 'В чому нараховується бонус',
            'bonus_one' => 'Бонус за штуку або л/кг якщо стоїть галочка',
            'bonus_all' => 'Бонус за сумарну кількість',
            'qty_sale' => 'Кількість, яку необхідно продати,щоб отримати бонус',
            'stage' => 'Кількість етапів',
            'percent_stage' => 'Відсоток по кожному з етапів, вказувати через ";", напр.: 3 етапи - 2;5;9',
            'money_plan' => 'Сума на яку потрібно продати, щоб отримати бонус',
            'date_from' => 'Дата початку',
            'date_to' => 'Дата закінчення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientType()
    {
        return $this->hasOne(ClientType::className(), ['id' => 'client_type_id']);
    }


    public function getCurrencyDropDownList(){
        $currency = array(0=>'грн', 1 => 'USD', 2 =>'Гектарчик');
        return $currency;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientTypeBonusRels()
    {
        return $this->hasMany(ClientTypeBonusRel::className(), ['ctype_bonus_id' => 'id']);
    }
    public function getManufacturer()
    {
        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);
    }

    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'attribute_value_id']);
    }

    public function getClientTypeBonuseAttribute()
    {
        return $this->hasOne(ClientTypeBonusAttribute::className(), ['rel' => 'ctype_bonus_av_rel']);
    }
}
