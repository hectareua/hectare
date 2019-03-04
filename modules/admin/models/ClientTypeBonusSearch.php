<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClientTypeBonus;

/**
 * ClientTypeBonusSearch represents the model behind the search form about `app\models\ClientTypeBonus`.
 */
class ClientTypeBonusSearch extends ClientTypeBonus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['client_type_id', 'qty_sale','manufacturer_id','stage','money_plan','show_condition','attribute_value_id', 'currency','ctype_bonus_av_rel','unit'], 'integer'],
            [['bonus_one', 'bonus_all'],'number'],
            [['name_bonus_uk','name_bonus_ru','percent_stage','condition_uk','condition_ru'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ClientTypeBonus::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'name_bonus_uk' => $this->name_bonus_uk,
            'condition_uk' => $this->condition_uk,
            'show_condition' => $this->show_condition,
            'client_type_id' => $this->client_type_id,
            'bonus_one' => $this->bonus_one,
            'bonus_all' => $this->bonus_all,
            'stage' => $this->stage,
            'money_plan' => $this->money_plan,
        ]);

        return $dataProvider;
    }
}
