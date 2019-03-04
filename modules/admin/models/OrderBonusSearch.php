<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrderBonus;

/**
 * OrderBonusSearch represents the model behind the search form about `app\models\OrderBonus`.
 */
class OrderBonusSearch extends OrderBonus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['ordered_at','user_id', 'product_bonus_id'], 'safe'],
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
        $query = OrderBonus::find();
        $query->joinWith(['productBonus'])
        ->joinWith(['user' => function($q){
            $q->joinWith(['client']);
        }]);

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
            'price' => $this->price,
            'ordered_at' => $this->ordered_at,
        ])
            ->andFilterWhere(['like', 'client.billing_last_name', $this->user_id])
            ->andFilterWhere(['like', 'product_bonus.name_uk', $this->product_bonus_id]);

        return $dataProvider;
    }
}
